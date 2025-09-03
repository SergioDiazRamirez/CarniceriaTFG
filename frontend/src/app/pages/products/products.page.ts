import { Component, OnInit, ViewChild } from '@angular/core';
import { ProductService } from 'src/app/services/product.service';
import { Product } from 'src/app/models/product.model';
import { TranslateService } from '@ngx-translate/core';
import { UiService } from 'src/app/services/ui.service';
import { Category } from 'src/app/models/category.model';
import { CategoryService } from 'src/app/services/category.service';
import { AuthService } from 'src/app/services/auth.service';
import { IonInfiniteScroll, NavController } from '@ionic/angular';

@Component({
  selector: 'app-products',
  templateUrl: './products.page.html',
  styleUrls: ['./products.page.scss'],
  standalone: false,
})
export class ProductsPage implements OnInit {
  products: Product[] = [];
  filteredProducts: Product[] = [];
  page = 1;
  searchTerm = '';
  categories: Category[] | null = null;
  selectedCategory: Category | null = null;
  loading = false;
  totalPages = 1;
  isFavoritesFilter = false;
  isInfiniteDisabled = false;

  constructor(private productService: ProductService, private uiService: UiService,
    private categoryService: CategoryService, private navCtrl: NavController, public authService: AuthService) { }

  ionViewWillEnter() {
    this.loadProducts();
  }

  ngOnInit() {
    this.loadCategories();
    this.loadProducts();
  }

  loadCategories() {
    this.categoryService.getCategories().subscribe({
      next: (res) => {
        this.categories = res
      },
      error: (err) => {
        console.error('Error cargando categorías', err);
        this.uiService.showToast('CATEGORY.LOAD_ERROR', 'danger');
      }
    });
  }

  loadProducts(page = 1, event?: any) {
    if (page > this.totalPages) {
      // if (event) event.target.disabled = true;
      return;
    }
    this.loading = true;
    const favoritesOnly = this.isFavoritesFilter ? '1' : '';
    this.productService.getProducts(page, this.searchTerm, this.selectedCategory?.id, favoritesOnly).subscribe({
      next: (res) => {
        this.page = res.current_page;
        this.totalPages = res.last_page;
        if (page === 1) this.products = res.data;
        else this.products = [...this.products, ...res.data];

        this.filteredProducts = this.products; // filtro simple local
        this.loading = false;

        if (event) event.target.complete();
        if (page >= this.totalPages) this.isInfiniteDisabled = true;
      },
      error: (err) => {
        this.loading = false
        console.error('Error cargando productos', err);
        this.uiService.showToast('PRODUCTS.LOAD_ERROR', 'danger');
      }
    });
  }

  filterProducts() {
    // Filtrado rápido local
    const term = this.searchTerm.toLowerCase();
    this.filteredProducts = this.products.filter(p => {
      const matchesName = p.name.toLowerCase().includes(term);
      const matchesCategory = !this.selectedCategory || (p.categories?.some(c => c.id === this.selectedCategory?.id));
      return matchesName && matchesCategory;
    });
    // TODO: Lanzar debounce para llamar al back (solo si cambió searchTerm o categoría)
    this.debounceSearch();
  }

  debounceSearch() {
    setTimeout(() => {
      this.page = 1;
      this.loadProducts(1);  // recarga desde backend con filtro
    }, 1000); // espera 1s para no saturar backend
  }

  // Evento scroll infinito
  loadMore(event: any) {
    this.loadProducts(++this.page, event);
  }

  //TODO: cuando se marca y desmarca una categoría, no se vuelven a mostrar todos los productos
  filterByCategory(category: Category) {
    this.selectedCategory = this.selectedCategory === category ? null : category;
    this.filterProducts();
    this.loadProducts();
  }

  goToDetail(product: Product) {
    this.navCtrl.navigateForward(['/tabs/product-detail', product.id], { state: { product } });
  }

  //TODO: showToast de UiService para iniciar sesión
  toggleFavorite(product: Product, event: Event) {
    event.stopPropagation(); // para que no navegue al detalle si clican el corazón
    if (product.isFavorite) {
      this.productService.removeFavorite(product.id).subscribe({
        next: () => product.isFavorite = false
      });
    } else {
      this.productService.addFavorite(product.id).subscribe({
        next: () => product.isFavorite = true
      });
    }
  }

  toggleFavoritesFilter() {
    this.isFavoritesFilter = !this.isFavoritesFilter;
    this.page = 1;
    this.products = [];
    this.filteredProducts = [];
    this.isInfiniteDisabled = false; // habilitar scroll infinito de nuevo
    this.loadProducts();
  }

}

