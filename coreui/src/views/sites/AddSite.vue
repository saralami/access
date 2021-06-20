<template>
  <div class="d-flex align-items-center min-vh-100">
    <CContainer fluid>
      <CRow class="justify-content-center">
        <CCol md="6">
          <CCard class="mx-4 mb-0">
            <CCardBody class="p-4">
              <CForm @submit.prevent="addSite" method="POST">
                <h1>Register</h1>
               <p class="text-muted">Ajouter un nouveau site a mettre sous surveillance</p>
               
             
                <CInput
                  placeholder="Nom ou enseigne du sie"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="nomsite"
                  v-model="nomSite"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="Adresse du site"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="adresseSite"
                  v-model="adresseSite"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="Nom responsable"
                  prependHtml="<i class='cui-user'></i>"
                  autocomplete="responsable"
                  v-model="responsable"
                >
                  <template #prepend-content><CIcon name="cil-user"/></template>
                </CInput>
                <CInput
                  placeholder="fonction du responsable"
                  prependHtml="<i class='cil-adress-book'></i>"  
                  autocomplete="fonction"
                  v-model="responsable"
                >
                <template #prepend-content><CIcon name="cil-adress-book"/></template>
                </CInput>
                <CInput
                  placeholder="Email"
                  prepend="@"
                  autocomplete="email"
                  v-model="email"
                />
               <CButton type="submit" color="success" block>Create Account</CButton>
              </CForm>
            </CCardBody>
            <!-- <CCardFooter class="p-4">
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
            </CCardFooter> -->
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
