<?php

use SleepingOwl\Admin\Navigation\Page;

// Default check access logic
// AdminNavigation::setAccessLogic(function(Page $page) {
// 	   return auth()->user()->isSuperAdmin();
// });
//
// AdminNavigation::addPage(\App\Model\User::class)
// ->setTitle('test')->setPages(function(Page $page) {
//     $page
//         ->addPage()
//         ->setTitle('Dashboard')
//         ->setUrl(route('admin.dashboard'))
//         ->setPriority(100);

//     $page->addPage(\App\Model\User::class);
// });
//
// // or
//

// AdminSection::addMenuPage(\App\Model\User::class)->setIcon("fa fa-user");
// AdminSection::addMenuPage(\App\Model\Product::class)->setIcon("fa fa-cart");

return [
    [
        'title' => 'Dashboard',
        'icon'  => 'fa fa-dashboard',
        'url'   => route('admin.dashboard'),
    ],
    [
        'title' => 'Information',
        'icon'  => 'fa fa-exclamation-circle',
        'url'   => route('admin.information'),
    ],
    [
        'title' => 'Tienda',
        'pages' => [
            (new Page(\App\Model\Order::class))->setTitle('Ordenes de compra'),
            (new Page(\App\Model\Product::class))->setTitle('Productos'),
            (new Page(\App\Model\Reference::class))->setTitle('Modelos'),
        ]
    ],
    [
      'title' => 'Configuracion',
      'pages' => [
        (new Page(\App\Model\Category::class))->setTitle('Categorías'),
        (new Page(\App\Model\Type::class))->setTitle('Talles'),
        (new Page(\App\Model\Brand::class))->setTitle('Marcas'),
        (new Page(\App\Model\Color::class))->setTitle('Colores'),
      ]
    ],
    [
      'title' => 'Inventario',
      'pages' => [
        (new Page(\App\Model\Stock::class))->setTitle('Stock'),
        [
            'title' => 'Registrar movimiento',
            'url'   => route('admin.add-stock.select-product')
        ]
      ]
    ],
    [
      'title' => 'Sitio',
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
