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
            $query->byProduct();
            $query->orderBy('created_at', 'desc');
        });
        $display->setFilters([
            AdminDisplayFilter::related('product_id')
                ->setModel(Product::class),
            AdminDisplayFilter::field('id')->setTitle('Busqueda por referencia')
        ]);
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#'),
            AdminColumn::custom()
                ->setLabel("Producto")
                ->setCallback(function ($instance) {
                    return "<a href='".url('admin/products/'.$instance->product_id.'/edit')."'>".$instance->product->title."</a>";
                }),
            AdminColumn::text('color')->setLabel('Color'),
            AdminColumn::text('qty')->setLabel('Stock')
        ]);
        $display->paginate(20);
        return $display;
    });
    $model->onCreate(function () {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('reference', 'Código de referencia')
                ->required(),
            AdminFormElement::select('product_id', 'Producto')
                ->setModelForOptions('App\Model\Product')
                ->setDisplay('title')
                ->setDefaultValue(Request::input('product_id'))
                ->required(),
            AdminFormElement::select('color_id', 'Color')
                ->setModelForOptions('App\Model\Color')
                ->setDisplay('name')
                ->setDefaultValue(Request::input('color_id'))
                ->required()
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
    // Create And Edit
    $model->onEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('reference', 'Código de referencia')
                ->required(),
            AdminFormElement::select('color_id', 'Color')
                ->setModelForOptions('App\Model\Color')
                ->setDisplay('name')
                ->setDefaultValue(Request::input('color_id'))
                ->required(),
            AdminFormElement::multiselect('sizes', 'Talles')
                ->taggable(),
            AdminFormElement::select('product_id', 'Producto')
                ->setModelForOptions('App\Model\Product')
                ->setDisplay('title')
                ->required()
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});