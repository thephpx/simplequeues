<template>
  <v-container>
  	<v-layout grid-list-xs text-xs-center row wrap>
		<v-flex xs6 offset-xs3 v-if="empty">
			<v-btn v-on:click="btnRequestToken"
			class="mx-0"
			color="primary"
			large
			>
			Request New Token
			</v-btn>
  		</v-flex>

  		<v-flex xs6 offset-xs3 v-if="!empty">
			<h3 v-bind:token="token">Token # {{token.token}}</h3>
			<v-btn v-on:click="btnClickSuccess"
			class="mx-0"
			color="success"
			large
			>
			Mark Completed
			</v-btn>
			&nbsp;
			<v-btn v-on:click="btnClickCancelled"
			class="mx-0"
			color="warning"
			large
			>
			Mark Cancelled
			</v-btn>
  		</v-flex>
  	</v-layout>
  </v-container>
</template>

<script>
import axios from 'axios';
export default{
	data(){
		return {
			apiBaseUrl: 'http://127.0.0.1',
			empty: true,
			token: {}
		}
	},
	methods:{
		getToken(){
			let self = this;
			let headers = {
				'Content-Type':'multipart/form-data'
			}
			axios.post(`${this.apiBaseUrl}/api/token/request`, {station_id:self.$route.params.station_id,agent_id:self.$route.params.agent_id},{headers:headers})
			.then(function(response){
				if(typeof(response.data.response) == undefined){
					self.token = {};				
				}else{
					self.empty = false;
					self.token = response.data.response;			
				}
				//console.log(response.data.response);
			})
			.catch(error => console.log('Error:'+error));

		},
		btnRequestToken(){
			this.getToken();
		},
		btnClickSuccess(){
			let self = this;
			let headers = {
				'Content-Type':'application/x-www-form-urlencoded'
			}
			axios.put(`${this.apiBaseUrl}/api/token/update/${self.token.id}`, {status:'success', _method:'PUT'}, {headers:headers})
			.then(function(response){
				self.empty = true;
			})
			.catch(error => console.log('Error:'+error));
		},
		btnClickCancelled(){
			let self = this;
			let headers = {
				'Content-Type':'application/x-www-form-urlencoded'
			}
			axios.put(`${this.apiBaseUrl}/api/token/update/${self.token.id}`, {status:'cancelled', _method:'PUT'}, {headers:headers})
			.then(function(response){
				self.empty = true;
			})
			.catch(error => console.log('Error:'+error));
		}
	},
	created(){		
		console.log(this.empty);
	}
}
</script>

<style>
</style>