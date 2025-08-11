import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { AbstractControl, FormBuilder, FormGroup, Validators } from '@angular/forms';
import { TranslateService } from '@ngx-translate/core';
import { UiService } from '../services/ui.service';

@Component({
  selector: 'app-register',
  templateUrl: './register.page.html',
  styleUrls: ['./register.page.scss'],
  standalone: false,
})
export class RegisterPage implements OnInit{
  registerForm!: FormGroup;
  
  constructor(private fb: FormBuilder, private http: HttpClient, 
    private router: Router, private translate: TranslateService,
    private uiService: UiService) 
    {}

  ngOnInit(){
    this.registerForm = this.fb.group({
      name: ['', [Validators.required]],
      email: ['', [Validators.required, Validators.email]],
      password: ['', [Validators.required, Validators.minLength(8)]],
      password_confirmation: ['', [Validators.required]],
    }, { validators: this.passwordsMatchValidator });
  }
passwordsMatchValidator = (group: AbstractControl) => {
  const pass = group.get('password')?.value;
  const confirm = group.get('password_confirmation')?.value;
  return pass === confirm ? null : { passwordsMismatch: true };
}
  
  onSubmit() {
    if (this.registerForm.invalid) {
      // Marcar todos como tocados para mostrar errores
      this.registerForm.markAllAsTouched();
      return;
    }

    this.http.post('http://localhost:8000/api/register', this.registerForm.value)
      .subscribe({
        next: (res: any) => {
          console.log('Registro exitoso', res);
          // Guardar token en localStorage
          localStorage.setItem('token', res.access_token);
          this.router.navigate(['/home']);
        },
        error: (err) => {
          console.error('Error en registro', err);
          if (err.error?.code === 'email_already_taken') {
            this.uiService.showToast('REGISTER', 'danger');
          } 
        }
      });
  }

  get name() { return this.registerForm.get('name'); }
  get email() { return this.registerForm.get('email'); }
  get password() { return this.registerForm.get('password'); }
  get password_confirmation() { return this.registerForm.get('password_confirmation'); }
}
