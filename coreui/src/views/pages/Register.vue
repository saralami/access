<template>
  <div class="d-flex align-items-center min-vh-100">
    <CContainer fluid>
      <CRow class="justify-content-center">
        <CCol md="6">
          <CCard class="mx-4 mb-0">
            <CCardBody class="p-4">
              <CForm @submit.prevent="register" method="POST">
                <h1>Register</h1>
               <p class="text-muted">Create your account</p>
               
               <div class="custom-control custom-radio custom-control-inline">
                <input 
                  type="radio" 
                  id="customRadioInline1" 
                  name="choix" 
                  v-model="choixrole"
                  value="client"
                  class="custom-control-input"
                 
                >
                <label class="custom-control-label" for="customRadioInline1">Client</label>
              </div>
              <div class="custom-control custom-radio custom-control-inline">
                <input 
                  type="radio" 
                  id="customRadioInline2" 
                  name="choix" 
                  v-model="choixrole"
                  value="partenaire"
                  class="custom-control-input"
                  
                >
                <label class="custom-control-label" for="customRadioInline2">Partenaire</label>
              </div>
              <br><br>
                <CInput
                  placeholder="Nom complet"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="username"
                  v-model="name"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="Entreprise"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="entreprise"
                  v-model="entreprise"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="Fonction"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="fonction"
                  v-model="fonction"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="Tel"
                  prependHtml="<i class='cil-adress-book'></i>"  
                  autocomplete="tel"
                  v-model="tel"
                >
                <template #prepend-content><CIcon name="cil-adress-book"/></template>
                </CInput>
                <CInput
                  placeholder="Email"
                  prepend="@"
                  autocomplete="email"
                  v-model="email"
                />
                <CInput
                  placeholder="Password"
                  type="password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  autocomplete="new-password"
                  v-model="password"
                >
                  <template #prepend-content><CIcon name="cil-lock-locked"/></template>
                </CInput>
                <CInput
                  placeholder="Repeat password"
                  type="password"
                  prependHtml="<i class='cui-lock-locked'></i>"
                  autocomplete="new-password"
                  class="mb-4"
                  v-model="password_confirmation"
                >
                  <template #prepend-content><CIcon name="cil-lock-locked"/></template>
                </CInput>
                <CButton type="submit" color="success" block>Create Account</CButton>
              </CForm>
            </CCardBody>
            <CCardFooter class="p-4">
              <CRow>
                <CCol col="6">
                  <CButton block color="facebook">
                    Facebook
                  </CButton>
                </CCol>
                <CCol col="6">
                  <CButton block color="twitter">
                    Twitter
                  </CButton>
                </CCol>
              </CRow>
            </CCardFooter>
          </CCard>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

  <script>
    import axios from 'axios'
    export default {
      data() {
        return {
          name: '',
          entreprise: '',
          fonction: '',
          tel: '',
          choixrole: '',
          email: '',
          password: '',
          password_confirmation: ''
        }
      },    
      methods: {
        register() {
          var self = this;
          axios.post(  this.$apiAdress + '/api/register', {
            name: self.name,
            entreprise: self.entreprise,
            fonction: self.fonction,
            email: self.email,
            tel: self.tel,
            choixrole: self.choixrole,
            password: self.password,
            password_confirmation: self.password_confirmation
          }).then(function (response) {
            self.name = '';
             self.entreprise = '';
             self.fonction = '';
             self.email = '';
            self.tel = '';
            self.choixrole = '';
            self.password = '';
            self.password_confirmation = '';
            console.log(response);
            self.$router.push({ path: '/login' });
          })
          .catch(function (error) {
            console.log(error);
          });
  
        }
      }
    }
  
  </script>
