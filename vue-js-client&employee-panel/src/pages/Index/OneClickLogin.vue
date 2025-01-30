<template>
    <div class="container-fluid">
        <div class="row">          
            <div class="loader_section">
                <div class="mesh-loader">
                    <div class="set-one">
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                    <div class="set-two">
                        <div class="circle"></div>
                        <div class="circle"></div>
                    </div>
                </div>
                <div class="loader_paragraph">
                    <p>Please Wait While We Fatch Your Data.....</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


import router from '@/routes';
import axios from "axios";
const apiUrl = import.meta.env.VITE_VUE_APP_APIURL; 
export default {
    name: 'Dashboard',
    data() {
        return {      
           havetoken : null,
        }
    },
    components: {
        // Header,
        // Leftside,
    },

    created() {
        var routeslug=this.$route.params.slug;
        var loginuserid=this.$route.params.id;
        // axios.get(`${apiUrl}/one_click_login/`+loginuserid)
        // .then((res) => { 
        //     // this.havetoken = res.data.authorization.token;
        //     localStorage.setItem('authToken', res.data.authorization.token);
        //     localStorage.setItem('LOGEDUSERTYPE', res.data.authorization.usertype);
        //     store.commit('userData', res.data.user);  
        //     router.push({name: 'Dashboard' });     
        // })
        // .catch(err =>{
        //     // alert('cjdbgjh')
        //     router.push({ name: 'Dashboard' }); 
        // });
        fetchDataAndRedirect(loginuserid);
        async function fetchDataAndRedirect(loginuserid) {
            try {
                const response = await axios.get(`${apiUrl}/one_click_login/` + loginuserid);
                // this.havetoken = response.data.authorization.token;



                localStorage.setItem('authToken', response.data.authorization.token);
                localStorage.setItem('LOGEDUSERTYPE', response.data.authorization.usertype);
                store.commit('userData', response.data.user);
                router.push({ name: 'Dashboard' });



            } catch (error) {
                // Handle error if needed
                console.error('Error fetching data:', error);
                router.push({ name: 'Dashboard' });
            }
        }
        
    },
};
</script>

<style>

.loader_section  {
    width: 100%;
    height: 100vh;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;
}

.loader_section .mesh-loader {
    overflow: hidden;
    height: 160px;
    width: 160px;
    position: relative;
}
.loader_section .mesh-loader .circle {
  width: 20px;
  height: 20px;
  position: absolute;
  background: #2c65e8;
  border-radius: 50%;
  margin: -10px;
  -webkit-animation: mesh 3s ease-in-out infinite -1.5s;
  animation: mesh 3s ease-in-out infinite -1.5s;
}

.loader_section .mesh-loader > div .circle:last-child {
  -webkit-animation-delay: 0s;
  animation-delay: 0s;
}

.loader_section .mesh-loader > div {
  position: absolute;
  top: 45%;
  left: 50%;
}

.loader_section .mesh-loader > div:last-child {
  -webkit-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  transform: rotate(90deg);
}

.loader_section .loader_paragraph p  {
    padding-top: 20px;
    font-size: 1.6rem;
    font-weight: 600;
    color: var(--mainfontcolur);
}

@-webkit-keyframes mesh {
  0% {
    -webkit-transform-origin: 50% -100%;
    transform-origin: 50% -100%;
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  50% {
    -webkit-transform-origin: 50% -100%;
    transform-origin: 50% -100%;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
  50.1% {
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 200%;
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform-origin: 50% 100%;
    transform-origin: 50% 200%;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

@keyframes mesh {
  0% {
    -webkit-transform-origin: 50% -100%;
    transform-origin: 50% -100%;
    -webkit-transform: rotate(0);
    transform: rotate(0);
  }
  50% {
    -webkit-transform-origin: 50% -100%;
    transform-origin: 50% -100%;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
  50.1% {
    -webkit-transform-origin: 50% 200%;
    transform-origin: 50% 200%;
    -webkit-transform: rotate(0deg);
    transform: rotate(0deg);
  }
  100% {
    -webkit-transform-origin: 50% 200%;
    transform-origin: 50% 200%;
    -webkit-transform: rotate(360deg);
    transform: rotate(360deg);
  }
}

</style>