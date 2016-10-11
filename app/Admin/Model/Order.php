<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */
use App\Model\Order;
use App\Model\Product;
use App\Model\Reference;

use SleepingOwl\Admin\Model\ModelConfiguration;
AdminSection::registerModel(Order::class, function (ModelConfiguration $model) {
    $model->setTitle("Ordenes de compra");
    $model->setAlias('orders');
    $model->onDisplay(function () {
        $display = AdminDisplay::datatables();
        $display->with('user', 'shippingarea');
        $display->setApply(function($query) {
            $query->orderBy('created_at', 'desc');
        });
        $display->setFilters([
          AdminDisplayFilter::field('id')->setTitle('Busqueda por id')
        ]);
        $display->setColumns([
            AdminColumn::text('id')->setLabel('#'),
            AdminColumn::text('price')->setLabel('Total'),
            AdminColumn::text('status')->setLabel('Estado de Envío'),
            AdminColumn::text('payment_status')->setLabel('Estado de Pago'),
            AdminColumn::text('shippingarea.name')->setLabel('Area de entrega'),
            AdminColumn::custom()
                ->setLabel("Productos")
                ->setCallback(function ($instance) {
                    $link  = url("admin/order_items?order_id=".$instance->id);
                    return '<a href="'.$link.'">Ver detalle</a>';
                }),
            AdminColumn::custom()
                ->setLabel("Pagos")
                ->setCallback(function ($instance) {
                    $link  = url("admin/payments?order_id=".$instance->id);
                    $total = $instance->payments->count();
                    return '<a href="'.$link.'">'.$total.'</a>';
                }),
            AdminColumn::custom()
                ->setLabel("Usuario")
                ->setCallback(function ($instance) {
                    $link  = url("admin/users?id=".$instance->user->id);
                    return '<a href="'.$link.'">'.$instance->user->email.'</a>';
                }),
            AdminColumn::datetime('created_at')->setLabel('Date')->setFormat('d.m.Y')->setWidth('150px'),
        ]);
        $display->paginate(5);
        return $display;
    });

    // Create And Edit
    $model->onCreateAndEdit(function() {
        $form = AdminForm::form()->setItems([

            AdminFormElement::select('status', 'Estado del envio')
                                    ->setOptions([
                                      NULL => '0 - En checkout',
                                      'PROCESANDO'=>'1 - Procesando',
                                      'EMPACANDO'=>'2 - Empacando',
                                      'ENVIADO'=>'3 - Enviado',
                                      'ENTREGADO'=>'4 - Entregado'])
                                    ->setDefaultValue('PROCESANDO'),
            AdminFormElement::select('payment_status', 'Estado del pago')
                                    ->setOptions([
                                      NULL => '0 - En checkout',
                                      'PENDIENTE' => '1 - Pendiente',
                                      'REVISION' => '2 - En revisión',
                                      'RECHAZADO'=>'3 - Rechazado',
                                      'PAGADO'=>'4 - Correcto',
                                    ])
                                    ->setDefaultValue('PENDIENTE'),
            AdminFormElement::wysiwyg('details', 'Comentarios', 'tinymce')
        ]);
        $form->getButtons()
            ->setSaveButtonText('Guardar')
            ->hideSaveAndCloseButton();
        return $form;
    });
});
