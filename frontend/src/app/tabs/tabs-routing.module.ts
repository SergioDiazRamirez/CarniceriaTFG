import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { TabsPage } from './tabs.page';

const routes: Routes = [
  {
    path: '',
    component: TabsPage,
    children: [
      {
        path: 'home',
        loadChildren: () => import('../home/home.module').then(m => m.HomePageModule)
      },
      {
        path: 'products',
        loadChildren: () => import('../pages/products/products.module').then(m => m.ProductsPageModule)
      },
      {
        path: 'product-detail/:id',
        loadChildren: () => import('../pages/product-detail/product-detail.module').then(m => m.ProductDetailPageModule)
      },
      {
        path: 'product-detail',
        loadChildren: () => import('../pages/product-detail/product-detail.module').then(m => m.ProductDetailPageModule)
      },
      {
        path: 'cart',
        loadChildren: () => import('../pages/cart/cart.module').then(m => m.CartPageModule)
      },
      // {
      //   path: 'profile',
      //   loadChildren: () => import('../profile/profile.module').then(m => m.ProfilePageModule)
      // },
      {
        path: '',
        redirectTo: '/tabs/products', //TODO: Cambiar por home
        pathMatch: 'full'
      }

    ]
  }
];


@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class TabsPageRoutingModule { }
