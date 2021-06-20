<template>
  <CRow>
    <CCol col="12" lg="6">
      <CCard no-header>
        <CCardBody>
          <h3>Show Email Template</h3>

          <h4>Name:</h4>
          <p>{{ site.nom_enseigne }}</p>
          <h4>Subject:</h4>
          <p>{{ site.adresse_site }}</p>
          <h4>Content:</h4> 
          <p>{{ site.nom_responsable }}</p>

          <CButton color="primary" @click="goBack">Back</CButton>
        </CCardBody>
      </CCard>
    </CCol>
  </CRow>
</template>

<script>
import axios from 'axios'
export default {
  name: 'User',
  data: () => {
    return {
      site: [],
    }
  },
  methods: {
    goBack() {
      this.$router.go(-1)
      // this.$router.replace({path: '/users'})
    }
  },
  mounted: function(){
    let self = this;
    axios.get(  this.$apiAdress + '/api/site/' + self.$route.params.id + '?token=' + localStorage.getItem("api_token"))
    .then(function (response) {
      self.site = response.data.site;
    }).catch(function (error) {
      console.log(error);
      self.$router.push({ path: '/login' });
    });
  }
}


</script>
