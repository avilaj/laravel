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
    $model->setTitle("Modelos");
    $model->setAlias('references');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->with('color', 'product');
        $display->setApply(function ($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setFilters([
            AdminDisplayFilter::related('product_id')
                ->setModel(Product::class)->setDisplay('title'),
            AdminDisplayFilter::field('id')->setTitle('Busqueda por referencia')
        ]);
        $display->setColumns([
            AdminColumn::text('reference')->setLabel('#'),
            AdminColumn::custom()
                ->setLabel("Ref")
                ->setCallback(function ($instance) {
                  if ($instance->product) {
                    return "<a href='"
                    .url('admin/products/'.$instance->product->id.'/edit')
                    ."'>"
                    .$instance->product->title
                    ."</a>";
                  }
                }),
            AdminColumn::text('color.name')->setLabel('Color'),
            AdminColumn::custom()
              ->setLabel('Stock')
              ->setCallback(function ($instance) {
                $link = route('admin.add-stock', $instance->product_id);
                $link.='?reference_id='.$instance->id;
                $elem = '<a href="'.$link.'">Actualizar</a>';
                return $instance->qty .' '. $elem;
              })
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
