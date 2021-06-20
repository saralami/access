<template>
  <CRow>
    <CCol col="12" xl="12">
      <transition name="slide">
      <CCard>
        <CCardBody>
            <h4>Sites sous surveillances</h4>
            <CButton class="m-3" color="primary" @click="createSite()">Ajouter un site</CButton>
            <CAlert
              :show.sync="dismissCountDown"
              color="primary"
              fade
            >
              ({{dismissCountDown}}) {{ message }}
            </CAlert>
            <CDataTable
              hover
              :items="items"
              :fields="fields"
              :items-per-page="10"
              pagination
            >
              <template #nomenseigne="{item}">
                <td>
                  <strong>{{item.nom_enseigne}}</strong>
                </td>
              </template>
              <template #adressesite="{item}">
                <td>
                  <strong>{{item.adresse_site}}</strong>
                </td>
              </template>
              <template #send="{item}">
                <td>
                  <CButton color="warning" @click="sendSite( item.id )">Send</CButton>
                </td>
              </template>
              <template #show="{item}">
                <td>
                  <CButton color="primary" @click="showSite( item.id )">Show</CButton>
                </td>
              </template>
              <template #edit="{item}">
                <td>
                  <CButton color="primary" @click="editSite( item.id )">Edit</CButton>
                </td>
              </template>
              <template #delete="{item}">
                <td>
                  <CButton color="danger" @click="deleteSite( item.id )">Delete</CButton>
                </td>
              </template>
            </CDataTable>
        </CCardBody>  
      </CCard>
      </transition>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'

export default {
  name: 'Sites',
  data: () => {
    return {
      items: [],
      fields: ['nomenseigne', 'adressesite',  'send', 'show', 'edit', 'delete'],
      currentPage: 1,
      perPage: 5,
      totalRows: 0,
      message: '',
      showMessage: false,
      dismissSecs: 7,
      dismissCountDown: 0,
      showDismissibleAlert: false
    }
  },
  computed: {
  },
  methods: {
    getRowCount (items) {
      return items.length
    },
    noteLink (id) {
      return `site/${id.toString()}`
    },
    editLink (id) {
      return `site/${id.toString()}/edit`
    },
    showSite ( id ) {
      const noteLink = this.noteLink( id );
      this.$router.push({path: noteLink});
    },
    editSite ( id ) {
      const editLink = this.editLink( id );
      this.$router.push({path: editLink});
    },
    // sendEmail ( id ){
    //     this.$router.push({path: `email/${id.toString()}/sendEmail`});
    // },
    deleteSite ( id ) {
      let self = this;
      let noteId = id;
      axios.post(  this.$apiAdress + '/api/site/' + id + '?token=' + localStorage.getItem("api_token"), {
        _method: 'DELETE'
      })
      .then(function (response) {
          self.message = 'Successfully deleted Email Template.';
          self.showAlert();
          self.getSites();
      }).catch(function (error) {
        console.log(error);
        self.$router.push({ path: '/login' });
      });
    },
    createSite () {
      this.$router.push({path: 'site/nouveau'});
    },
    countDownChanged (dismissCountDown) {
      this.dismissCountDown = dismissCountDown
    },
    showAlert () {
      this.dismissCountDown = this.dismissSecs
    },
    getSites (){
      let self = this;
      axios.get(  this.$apiAdress + '/api/site?token=' + localStorage.getItem("api_token") )
      .then(function (response) {
       //alert (console.log('response.data'));
        self.items = response.data;
      }).catch(function (error) {
        console.log(error);
        //self.$router.push({ path: '/login' });
      });
    }
  },
  mounted: function(){
    this.getSites();
  }
}
</script>

<style scoped>
.card-body >>> table > tbody > tr > td {
  cursor: pointer;
}
</style>