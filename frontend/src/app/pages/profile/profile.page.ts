import { Component, OnInit } from '@angular/core';
import { AuthService } from '../../services/auth.service';
import { ToastController, AlertController } from '@ionic/angular';
import { Router } from '@angular/router';
import { User } from 'src/app/models/user.model';
import { TranslateService } from '@ngx-translate/core';
import { FormArray, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { debounceTime } from 'rxjs';
import { UserService } from 'src/app/services/user.service';

@Component({
  selector: 'app-profile',
  templateUrl: './profile.page.html',
  styleUrls: ['./profile.page.scss'],
  standalone: false,
})
export class ProfilePage implements OnInit {
  user !: User;
  editName = false;
  editEmail = false;
  userForm!: FormGroup;
  constructor(private userService: UserService, private toastCtrl: ToastController,
    private alertCtrl: AlertController, private router: Router, private translate: TranslateService,
    private fb: FormBuilder, private authService: AuthService) { }

  ngOnInit() {
    this.loadUser();
  }
  ionViewWillLeave() {
    //TODO: al cerrar sesión muestra perfil actualizado
    if (this.userForm.dirty)
      this.showToast(this.translate.instant('UPDATED_PROFILE'));
    this.saveChanges();
  }

  loadUser() {
    this.userService.getUser().subscribe({
      next: (user) => {
        this.userForm = this.fb.group({
          name: [user.name, Validators.required],
          email: [user.email, [Validators.required, Validators.email]],
          addresses: this.fb.array(user.addresses.map(addr => this.createAddressGroup(addr, addr.id === user.default_address_id)))
        });

      },
      error: async () => { this.showToast('Error al cargar perfil'); }
    });
  }

  get addresses(): FormArray {
    return this.userForm.get('addresses') as FormArray;
  }

  createAddressGroup(address?: any, isDefault = false): FormGroup {
    return this.fb.group({
      id: [address?.id || null],
      full_address: [address?.full_address, Validators.required],
      is_default: [isDefault]
    });
  }

  addAddress() {
    if (this.addresses.length < 5)
      this.addresses.push(this.createAddressGroup());
  }

  saveChanges() {
    const addressesArray = this.userForm.get('addresses') as FormArray;
    // Recorremos al revés para no desajustar los índices por comprobar al eliminar un elemento
    for (let i = addressesArray.length - 1; i >= 0; i--) {
      const value = addressesArray.at(i).get('full_address')?.value;
      if (!value || value.trim() === '') {
        addressesArray.removeAt(i);
      }
    }
    if (this.userForm.valid) {
      this.userService.updateUser(this.userForm.value).subscribe(() => {
        console.log('Perfil guardado');
      });
    } else {
      console.log("Formulario inválido, no se guardan los cambios");
    }
  }

  async deleteAddress(index: number) {
    const alert = await this.alertCtrl.create({
      header: this.translate.instant('CONFIRM'),
      message: this.translate.instant('DELETE_ADDRESS_CONFIRM'),
      buttons: [
        { text: this.translate.instant('CANCEL'), role: 'cancel' },
        {
          text: this.translate.instant('DELETE'),
          role: 'destructive',
          handler: () => {
            this.addresses.removeAt(index);
            this.saveChanges();
          },
        },
      ],
    });
    await alert.present();
  }
  goToOrders() {
    this.router.navigate(['/tabs/orders']);
  }

  goToCards() {
    //TODO: Navegar a la página de tarjetas
  }
  async changePassword() {
    const alert = await this.alertCtrl.create({
      header: this.translate.instant('CHANGE_PASSWORD'),
      inputs: [
        { name: 'current_password', type: 'password', placeholder: this.translate.instant('CURRENT_PASSWORD') },
        { name: 'new_password', type: 'password', placeholder: this.translate.instant('NEW_PASSWORD') },
        { name: 'new_password_confirmation', type: 'password', placeholder: this.translate.instant('CONFIRM_PASSWORD') }
      ],
      buttons: [
        { text: this.translate.instant('CANCEL'), role: 'cancel' },
        {
          text: this.translate.instant('ACCEPT'),
          handler: (data) => {
            this.userService.changePassword(data).subscribe({
              next: () => this.showToast(this.translate.instant('PASSWORD_CHANGED')),
              error: (err) => {
                let msgKey: string;
                if (err.status === 422 || err.status === 400) // TODO: códigos de error en tfg
                  msgKey = err.error?.message
                else
                  msgKey = 'ERROR_PASSWORD_CHANGE';

                this.showToast(this.translate.instant(msgKey));
              }
            });
          }
        }
      ]
    });
    await alert.present();
  }

  logout() {
    this.authService.logout();
    this.showToast(this.translate.instant('LOGGED_OUT'));
    this.router.navigate(['/tabs/products']);  
  }

  async deleteAccount() {
    const alert = await this.alertCtrl.create({
      header: this.translate.instant('DELETE_ACCOUNT'),
      message: this.translate.instant('DELETE_ACCOUNT_CONFIRMATION'),
      buttons: [
        { text: this.translate.instant('CANCEL'), role: 'cancel' },
        {
          text: this.translate.instant('DELETE'),
          handler: () => {
            this.userService.deleteAccount().subscribe({
              next: () => this.showToast(this.translate.instant('DELETED_ACCOUNT')),
              error: () => this.showToast(this.translate.instant('ERROR_ACCOUNT_DELETION')),
            });
          }
        }
      ]
    });
    await alert.present();
  }

  private async showToast(msg: string) {
    const toast = await this.toastCtrl.create({ message: msg, duration: 2000 });
    toast.present();
  }
}

