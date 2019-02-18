<template>
  <v-container>
  	<v-layout text-xs-center wrap>
  		<v-flex xs-12>
  			<v-jumbotron>
			    <v-container fill-height>
			      <v-layout align-center>
			        <v-flex>
			          <h3 class="display-3">Welcome to Simple Queues</h3>

			          <v-divider class="my-3"></v-divider>

			          <div class="title mb-3">Click the following button to print your token!</div>

			          <v-btn v-on:click="printButtonClick"
			            class="mx-0"
			            color="primary"
			            large
			          >
			            Click to Print Token
			          </v-btn>
			        </v-flex>
			      </v-layout>
			    </v-container>
			</v-jumbotron>
  		</v-flex>
  	</v-layout>
  </v-container>
</template>

<script>
import axios from 'axios';
export default{
	data(){
		return {
			'apiBaseUrl': 'http://127.0.0.1'
		}
	},
	methods:{
		printButtonClick(){
			let self = this;
			let headers = {
				'Content-Type':'multipart/form-data'
			}
			axios.post(`${this.apiBaseUrl}/api/token/create`,{'station_id':self.$route.params.station_id},{headers:headers})
			.then(function(response){
				console.log(response);
			})
			.catch(error => console.log(error))
		}
	}
}
</script>

<style>
</style>