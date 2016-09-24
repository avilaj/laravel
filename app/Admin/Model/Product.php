<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Product;
use App\Model\Reference;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Product::class, function (ModelConfiguration $model) {
    $model->setTitle("Productos");
    $model->setAlias('products');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('title')->setLabel('Producto'),
            AdminColumn::custom()
              ->setLabel('Stock')
              ->setCallback(function ($instance) {
                $link = route('admin.add-stock', $instance->id);
                $elem = '<a href="'.$link.'">Actualizar</a>';
                return $instance->qty .' '. $elem;
              }),
            AdminColumn::custom()
                ->setLabel("Colores")
                ->setCallback(function ($instance) {
                    $link  = url("admin/references?product_id=".$instance->id);
                    $label = $instance->references->unique('color_id')->count();
                    if ($label < 1 ) {
                        $label = $label . " <small>(Añadir)</small>";
                    } else {
                        $label = $label . " <small>(Mostrar)</small>";
                    }
                    return '<a href="'.$link.'">'.$label.'</a>';
                }),
            AdminColumn::datetime('created_at')
                                    ->setLabel('Date')
                                    ->setFormat('d.m.Y')
                                    ->setWidth('150px'),
        ]);
        $display->paginate(5);
        $display->with('references');
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Producto')->required(),
            AdminFormElement::text('price', 'Precio')->required(),
            AdminFormElement::images('images_for_admin', 'Imágenes'),
            AdminFormElement::select('brand_id', 'Marca')
              ->setModelForOptions('App\Model\Brand')
              ->setDisplay('name'),
            AdminFormElement::multiselect('colors', 'Colores')
                                    ->setModelForOptions('App\Model\Color')
                                    ->setDisplay('name')
                                    // ->setOptions(\App\Model\Color::get()->lists('name', 'id')->toArray())
                                    ->required(),
            AdminFormElement::select('gender', 'Genero')
                                    ->setOptions([
                                        'F'=>'Femenino',
                                        'M'=>'Masculino',
                                        'U'=>'Unisex'])
                                    ->setDefaultValue('M'),
            AdminFormElement::select('type_id', 'Talles')
                                    ->setModelForOptions('App\Model\Type')
                                    ->setDisplay('label')
                                    ->setDefaultValue(Request::input('type_id'))
                                    ->required(),
            AdminFormElement::select('category_id', 'Categoria')
                                    ->setModelForOptions('App\Model\Category')
                                    ->setDisplay('name')
                                    ->setDefaultValue(Request::input('category_id'))
                                    ->required(),
            AdminFormElement::wysiwyg('description', 'Descripción', 'tinymce')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
