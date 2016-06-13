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
                ->setLabel("Referencias")
                ->setCallback(function ($instance) {
                    $link  = url("admin/references?product_id=".$instance->id);
                    $label = $instance->references->count();
                    if ($label < 1 ) {
                        $label = $label . " <small>(Añadir)</small>";
                    }
                    return '<a href="'.$link.'">'.$label.'</a>';
                }),
            AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
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
            AdminFormElement::jsonField('references', 'Referencias'),
            AdminFormElement::select('category_id', 'Categoria')->setModelForOptions('App\Model\Category')->setDisplay('name')->required(),
            AdminFormElement::wysiwyg('description', 'Descripción', 'tinymce')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});