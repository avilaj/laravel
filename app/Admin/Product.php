<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Product;
use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Product::class, function (ModelConfiguration $model) {
    $model->setTitle("Productos");
    $model->onDisplay(function () {
        return AdminDisplay::table()->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        })->setColumns([
            AdminColumn::text('title')->setLabel('Producto'),
            AdminColumn::text('thumbnail')->setLabel('Imagen')
            // AdminColumn::datetime('date')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
            // AdminColumnEditable::checkbox('published')->setLabel('Published'),
        ])->paginate(5);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Producto')->required(),
            AdminFormElement::text('reference', 'Referencia')->required()->unique(),
            AdminFormElement::text('subtitle', 'Subtitulo')->required(),
            AdminFormElement::select('category_id', 'Categoria')->setModelForOptions('App\Model\Category')->setDisplay('name')->required(),
            AdminFormElement::text('tags', 'Serie')
            // AdminFormElement::checkbox('published', 'Published'),
            // AdminFormElement::wysiwyg('text', 'Text'),
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});