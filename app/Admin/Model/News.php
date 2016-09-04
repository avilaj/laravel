<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\News;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(News::class, function (ModelConfiguration $model) {
    $model->setTitle("Novedades");
    $model->setAlias('news');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setColumns([
            AdminColumn::text('title')->setLabel('Título'),
            AdminColumn::datetime('created_at')
                                    ->setLabel('Date')
                                    ->setFormat('d.m.Y')
                                    ->setWidth('150px'),
        ]);
        $display->paginate(12);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('title', 'Título')->required(),
            AdminFormElement::checkbox('pin', 'Destacado en home'),
            AdminFormElement::text('short_text', 'Reseña')->required(),
            AdminFormElement::wysiwyg('text', 'Text', 'tinymce')->required(),
            AdminFormElement::images('gallery_for_admin', 'Imágenes'),
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
