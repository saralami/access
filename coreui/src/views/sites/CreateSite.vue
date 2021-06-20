<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard no-header>
        <CCardBody>
          <h4>
            Ajouter un site
          </h4>
          <CAlert
            :show.sync="dismissCountDown"
            color="primary"
            fade
          >
            ({{dismissCountDown}}) {{ message }}
          </CAlert>

            <CInput label="Nom ou enseigne" type="text" placeholder="Nom ou enseigne" v-model="nom_enseigne"></CInput>

            <CInput label="Adresse du site" type="text" placeholder="Adresse du site" v-model="adresse_site"></CInput>

            <CInput label="Nom responsable" type="text" placeholder="Nom responsable" v-model="nom_responsable"></CInput>

            <CInput label="Fonction responsable" type="text" placeholder="Fonction responsable" v-model="fonction_responsable"></CInput>

            <CInput label="Email responsable" type="email" placeholder="Email responsable" v-model="email_responsable"></CInput>

            <CInput label="Tel du site" type="text" placeholder="Tel du site" v-model="tel_site"></CInput>

            

          <CButton color="primary" @click="nouveau()">Ajouter</CButton>
          <CButton color="primary" @click="goBack">Précédent</CButton>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'CreateSite',
  data: () => {
    return {
       
            nom_enseigne: '',
            adresse_site: '',
            nom_responsable: '',
            fonction_responsable: '',
            email_responsable: '',
            tel_site: '',
       
        message: '',
        dismissSecs: 7,
        dismissCountDown: 0,
        showDismissibleAlert: false
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/users'})
    },
    // store() {
    //     let self = this;
    //     axios.post(  this.$apiAdress + '/api/nouveau?token=' + localStorage.getItem("api_token"),
    //       self.site
    //     )
    //     .then(function (response) {
    //         self.site = {
    //              nom_enseigne: '',
    //              adresse_site: '',
    //              nom_responsable: '',
    //              fonction_responsable: '',
    //              email_responsable: '',
    //              tel_site: '',
    //         }
    //         self.message = 'Nouveau site ajouté avec succés.';
    //         self.showAlert();
    //     }).catch(function (error) {
    //         if(error.response.data.message == 'The given data was invalid.'){
    //           self.message = '';
    //           for (let key in error.response.data.errors) {
    //             if (error.response.data.errors.hasOwnProperty(key)) {
    //               self.message += error.response.data.errors[key][0] + '  ';
    //             }
    //           }
    //           self.showAlert();
    //         }else{
    //           console.log(error);
    //          // self.$router.push({ path: 'login' }); 
    //         }
    //     });
    // },

     nouveau() {
          var self = this;
          axios.post(  this.$apiAdress + '/api/nouveau', {
             nom_enseigne: self.nom_enseigne,
            adresse_site: self.adresse_site,
            nom_responsable: self.nom_responsable,
            fonction_responsable: self.fonction_responsable,
            email_responsable: self.email_responsable,
            tel_site: self.tel_site
          }).then(function (response) {
            self.nom_enseigne = '';
            self.adresse_site = '';
            self.nom_responsable = '';
            self.fonction_responsable = '';
            self.email_responsable = '';
            self.tel_site = '';
            console.log(response);
            self.$router.push({ path: '/login' });
          })
          .catch(function (error) {
            console.log(error);
          });
  
        },
       countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
  },
  mounted: function(){

  }
}

</script>
