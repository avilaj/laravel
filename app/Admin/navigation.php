<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//

return [
    (new Page(\App\Model\Message::class))->setTitle('Mensajes'),
    [
      'title' => 'Blog',
      'priority' => 3,
      'pages' => [
        (new Page(\App\Model\Podcast::class))->setTitle('Podcast'),
        (new Page(\App\Model\News::class))->setTitle('Noticias'),
      ]
    ],
    [
        'title' => 'Tienda',
        'priority' => 1,
        'pages' => [
            (new Page(\App\Model\Order::class))->setTitle('Ordenes de compra'),
            (new Page(\App\Model\Product::class))->setTitle('Productos'),
            (new Page(\App\Model\Reference::class))->setTitle('Modelos'),
        ]
    ],
    [
      'title' => 'Inventario',
      'priority' => 2,
      'pages' => [
        (new Page(\App\Model\Stock::class))->setTitle('Stock'),
        [
            'title' => 'Registrar movimiento',
            'url'   => route('admin.add-stock.select-product')
        ]
      ]
    ],
    [
      'title' => 'Mercadopago',
      'priority' => 3,
      'pages' => [
        (new Page(\App\Model\Notification::class))->setTitle('Notificaciones'),
        (new Page(\App\Model\Payment::class))->setTitle('Pagos'),
      ]
    ],
    [
      'title' => 'Configuracion',
      'priority' => 4,
      'pages' => [
        (new Page(\App\Model\Category::class))->setTitle('Categorías'),
        (new Page(\App\Model\Type::class))->setTitle('Talles'),
        (new Page(\App\Model\Brand::class))->setTitle('Marcas'),
        (new Page(\App\Model\Color::class))->setTitle('Colores'),
      ]
    ],
    (new Page(\App\Model\Slideshow::class))->setTitle('Slideshows'),
    [
      'title' => 'Sitio',
      'priority' => 5,
      'url' => route('admin.settings')
    ],

    // Examples
    // [
    //    'title' => 'Content',
    //    'pages' => [
    //
    //        \App\User::class,
    //
    //        // or
    //
    //        (new Page(\App\User::class))
    //            ->setPriority(100)
    //            ->setIcon('fa fa-user')
    //            ->setUrl('users')
    //            ->setAccessLogic(function (Page $page) {
    //                return auth()->user()->isSuperAdmin();
    //            }),
    //
    //        // or
    //
    //        new Page([
    //            'title'    => 'News',
    //            'priority' => 200,
    //            'model'    => \App\News::class
    //        ]),
    //
    //        // or
    //        (new Page(/* ... */))->setPages(function (Page $page) {
    //            $page->addPage([
    //                'title'    => 'Blog',
    //                'priority' => 100,
    //                'model'    => \App\Blog::class
	//		      ));
    //
	//		      $page->addPage(\App\Blog::class);
    //	      }),
    //
    //        // or
    //
    //        [
    //            'title'       => 'News',
    //            'priority'    => 300,
    //            'accessLogic' => function ($page) {
    //                return $page->isActive();
    //		      },
    //            'pages'       => [
    //
    //                // ...
    //
    //            ]
    //        ]
    //    ]
    // ]
];
