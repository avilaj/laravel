<?php

use App\Model\Configuration;
use SleepingOwl\Admin\Model\ModelConfiguration;

AdminSection::registerModel(Configuration::class, function (ModelConfiguration $model) {
    $model->setTitle('Form Items');
    // Display
    $model->onDisplay(function () {
        $display = AdminDisplay::table();
        return $display;
    });
    // Create And Edit
    $model->onCreateAndEdit(function($id = null) {
        $form = AdminForm::panel()
            ->addBody([
                AdminFormElement::text('collection_title', 'Título'),
                AdminFormElement::text('collection_subtitle', 'Subtítulo'),
                AdminFormElement::text('collection_description', 'Descripción'),
            ])
            ->addBody([
                // AdminFormElement::text('home_products', 'Productos destacados'),
            ])
            ->addBody([
                // AdminFormElement::images('home_slider', 'Slider'),
            ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
