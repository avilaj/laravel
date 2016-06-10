<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\User;
use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(User::class, function (ModelConfiguration $model) {
    $model->setTitle("Usuarios");
    $model->onDisplay(function () {
        return AdminDisplay::table()->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        })->setColumns([
            AdminColumn::text('name')->setLabel('Nombre'),
            AdminColumn::text('email')->setLabel('Email')
            // AdminColumn::datetime('date')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
            // AdminColumnEditable::checkbox('published')->setLabel('Published'),
        ])->paginate(5);
    });
    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([
            AdminFormElement::text('name', 'Nombre')->required(),
            AdminFormElement::text('email', 'Email')->required()->unique()
            // AdminFormElement::checkbox('published', 'Published'),
            // AdminFormElement::wysiwyg('text', 'Text'),
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar usuario')
            ->hideSaveAndCloseButton();
        return $form;
    });
});