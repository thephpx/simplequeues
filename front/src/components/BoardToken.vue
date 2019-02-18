<template>
  <v-container>
  	<v-layout grid-list-xs text-xs-center row wrap>
  		<v-flex xs6 offset-xs3>
	  		<v-data-table v-bind:headers="headers" v-bind:items="tokens" hide-actions class="elevation-1">
			    <template slot="items" slot-scope="props">
			      <td class="headline">{{ props.item.token }}</td>
			      <td class="headline">{{ props.item.status }}</td>
			    </template>
	  		</v-data-table>
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
			headers:[
				{
					text: 'Token No',
					value: 'token',
					class: 'headline text-xs-center',
					sortable: false
				},
				{
					text: 'Status',
					value: 'desk',
					class: 'headline text-xs-center',
					sortable: false
				}
			],
			tokens:[]
		}
	},
	methods:{
		getTokens(){
			let self = this;
			let headers = {
				'Content-Type':'multipart/form-data'
			}
			axios.get(`${this.apiBaseUrl}/api/token/bystation/${self.$route.params.station_id}`, {headers:headers})
			.then(function(response){
				self.tokens = response.data.response;
			})
			.catch(error => console.log('Error:'+error));
		}
	},
	created(){		
		this.getTokens();
	}
}
</script>

<style>
</style>