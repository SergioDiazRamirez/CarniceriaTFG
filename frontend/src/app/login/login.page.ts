import { Component, OnInit } from '@angular/core';
import { FormBuilder, FormGroup, Validators } from '@angular/forms';
import { AuthService } from '../services/auth.service';
import { Router } from '@angular/router';
import { UiService } from '../services/ui.service';

@Component({
  selector: 'app-login',
  templateUrl: './login.page.html',
  styleUrls: ['./login.page.scss'],
  standalone: false,
})
export class LoginPage implements OnInit {

  loginForm!: FormGroup
  passwordFieldType: string = 'password';

  constructor(private fb: FormBuilder, private authService: AuthService, private router: Router,
              private uiService: UiService
  ) { }

  ngOnInit() {
    this.loginForm = this.fb.group({
      email: ['', [Validators.required, Validators.email]],
      password: ['', Validators.required],
    });
  }

  ionViewWillEnter() {
    this.loginForm.reset();
  }
  
  get email() {
    return this.loginForm.get('email');
  }
  get password() {
    return this.loginForm.get('password');
  }

  onSubmit() {
    // TODO: spiner de carga
    if (this.loginForm.invalid) {
      // TODO: Mostrar mensaje de error o feedback visual al usuario
      return;
    }
    this.authService.login(this.loginForm.value).subscribe({
      next: async (res) => {
        await this.authService.setToken(res.access_token); //TODO: con el tiempo el back deci unauthorized
        console.log('Login exitoso', res);
        this.router.navigate(['tabs']);
      },
      error: (err) => {
        console.error('Error de login', err);
        this.uiService.showToast('LOGIN.INVALID_CREDENTIALS', 'danger');
      }
    });
  }

  togglePasswordVisibility() {
    this.passwordFieldType = this.passwordFieldType === 'password' ? 'text' : 'password';
  }
}