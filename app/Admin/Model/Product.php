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
        $display = AdminDisplay::table();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('title')->setLabel('Producto'),
            AdminColumn::text('qty')->setLabel('Stock'),
            AdminColumn::custom()
                ->setLabel("Modelos")
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
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Producto')->required(),
            AdminFormElement::text('subtitle', 'Subtitulo')->required(),
            AdminFormElement::text('price', 'Precio')->required(),
            AdminFormElement::multiselect('variations', 'Variantes')
                                    ->setOptions(\App\Model\Color::get()->lists('name', 'id')->toArray())
                                    ->required(),
            AdminFormElement::select('gender', 'Genero')
                                    ->setOptions([
                                        'F'=>'Femenino',
                                        'M'=>'Masculino',
                                        'U'=>'Unisex'])
                                    ->setDefaultValue('M'),
            AdminFormElement::select('type_id', 'Tipo')
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
