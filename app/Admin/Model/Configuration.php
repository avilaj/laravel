<?php

use App\Model\Configuration;
use SleepingOwl\Admin\Model\ModelConfiguration as ModConf;

AdminSection::registerModel(Configuration::class, function (ModConf $model)
{
    $model->setTitle('Configuracion');
    // $model->setAlias('configuration');
    // Display
    // Create And Edit
    $model->onEdit(function ($id = 1)
    {
        $form = AdminForm::form();
        // $form->setAction('/admin/settings/save');
        $form->setItems([
                AdminFormElement::text('collection_title', 'Título'),
                AdminFormElement::text('home_products', 'Prductos'),
                AdminFormElement::text('collection_description', 'Descripción'),
            ]);
            // ->addBody([
            //     // AdminFormElement::text('home_products', 'Productos destacados'),
            // ])
            // ->addBody([
            //     // AdminFormElement::images('home_slider', 'Slider'),
            // ])
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton()
            ->hideSaveAndCreateButton();
        return $form;
    });
});
