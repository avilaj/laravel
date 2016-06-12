<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Reference;
use App\Model\Product;
use SleepingOwl\Admin\Model\ModelConfiguration;
use SleepingOwl\Admin\Display\Filter\FilterBase;
AdminSection::registerModel(Reference::class, function (ModelConfiguration $model) {
    $model->setTitle("Referencias");
    $model->setAlias('references');
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
        $display->with('product');
        $display->setApply(function ($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setFilters([
            AdminDisplayFilter::related('product_id')
                ->setModel(Product::class)
        ]);
        $display->setColumns([
            AdminColumn::text('reference')->setLabel('Código de referencia'),
            AdminColumn::text('qty')->setLabel('Stock'),
            AdminColumn::relatedLink('product_id')
                ->setModel(new Product)
                ->setLabel('Producto')
                ->append(
                    AdminColumn::filter('product_id')->setModel(new Product)
                )
        ]);
        $display->paginate(5);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('reference', 'Código de referencia')
                ->required(),
            AdminFormElement::select('product_id', 'Producto')
                ->setModelForOptions('App\Model\Product')
                ->setDisplay('title')
                ->required(),
            AdminFormElement::text('specs', 'Especificaciones')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});