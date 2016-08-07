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
        $form->setItems([
                AdminFormElement::text('collection_title', 'Título'),
                AdminFormElement::multiselect('home_products', 'Blabla')
                                        ->setOptions(\App\Model\Products::get()->lists('title', 'id')->toArray())
                                        ->required(),
                AdminFormElement::text('collection_description', 'Descripción'),
            ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton()
            ->hideSaveAndCreateButton();
        return $form;
    });
});
