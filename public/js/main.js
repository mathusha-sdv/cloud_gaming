
$(document).ready(function(){
  $("#launch-game").click(function(){
var myHeaders = new Headers();
myHeaders.append("Content-Type", "application/x-www-form-urlencoded");
myHeaders.append("Cookie", "fpc=ApOMABDp_DNHlTve2NxnRnznLDjgAQAAABuoa9gOAAAA; stsservicecookie=estsfd; x-ms-gateway-slice=estsfd");
myHeaders.append("Access-Control-Allow-Origin", "*");
myHeaders.append("Access-Control-Expose-Headers", "Content-Length,API-Key")

var urlencoded = new URLSearchParams();
urlencoded.append("grant_type", "client_credentials");
urlencoded.append("client_id", "579a538f-85d1-4327-871d-43ab46bc363f");
urlencoded.append("client_secret", "fS-t~5qv~0x8Bf0qpdlexJ6L6gIdGzB3DC");
urlencoded.append("resource", "https://management.azure.com/");

var requestOptions = {
  method: 'POST',
  headers: myHeaders,
  body: urlencoded,
  redirect: 'follow',
  credentials: "include"
};

fetch("https://login.microsoftonline.com/b7b023b8-7c32-4c02-92a6-c8cdaa1d189c/oauth2/token", requestOptions)
  .then(response => response.json())
  .then(result => console.log(result))
  .catch(error => console.log('error', error));
});
      
   /* $.ajax({
      url:"https://management.azure.com/subscriptions/bb8f88c1-0d2d-4e9c-a732-3ecadfdeed9a/resourceGroups/NetworkWatcherRG/providers/Microsoft.Web/sites/UnityTourellle/restart?api-version=2019-08-01",
      type:"POST",
      headers: { 
        'Authorization': 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsIng1dCI6Im5PbzNaRHJPRFhFSzFqS1doWHNsSFJfS1hFZyIsImtpZCI6Im5PbzNaRHJPRFhFSzFqS1doWHNsSFJfS1hFZyJ9.eyJhdWQiOiJodHRwczovL21hbmFnZW1lbnQuY29yZS53aW5kb3dzLm5ldC8iLCJpc3MiOiJodHRwczovL3N0cy53aW5kb3dzLm5ldC9iN2IwMjNiOC03YzMyLTRjMDItOTJhNi1jOGNkYWExZDE4OWMvIiwiaWF0IjoxNjI0ODI5Mzk4LCJuYmYiOjE2MjQ4MjkzOTgsImV4cCI6MTYyNDgzMzI5OCwiYWNyIjoiMSIsImFpbyI6IkUyWmdZTkRONVVvc2Q0M2QzVEpkOWU1ZXZWMldNcUlIbjdlOVpuSy9xS2NScnZWL25nSUEiLCJhbXIiOlsicHdkIl0sImFwcGlkIjoiN2Y1OWE3NzMtMmVhZi00MjljLWEwNTktNTBmYzViYjI4YjQ0IiwiYXBwaWRhY3IiOiIyIiwiZmFtaWx5X25hbWUiOiJUSElSVUxPR0FTSU5HQU0iLCJnaXZlbl9uYW1lIjoiTWF0aHVzaGEiLCJpcGFkZHIiOiI4OC4xMjUuMTI3LjY5IiwibmFtZSI6IlRISVJVTE9HQVNJTkdBTSBNYXRodXNoYSIsIm9pZCI6Ijk1MGNhYTZjLWY1MWYtNDFlZi1iMWNhLWZjZTkyYTFjMjEzYSIsInB1aWQiOiIxMDAzMjAwMEVGMEE2OTBCIiwicmgiOiIwLkFTQUF1Q093dHpKOEFreVNwc2pOcWgwWW5IT25XWC12THB4Q29GbFFfRnV5aTBRZ0FHZy4iLCJzY3AiOiJ1c2VyX2ltcGVyc29uYXRpb24iLCJzdWIiOiJnSFBjWnpTbWVLdG5oTzA3Y1ZWcHJ6UGpwMXhEWThSdi0zYm5GbF9ocmhZIiwidGlkIjoiYjdiMDIzYjgtN2MzMi00YzAyLTkyYTYtYzhjZGFhMWQxODljIiwidW5pcXVlX25hbWUiOiJtYXRodXNoYS50aGlydWxvZ2FzaW5nYW1Ac3VwZGV2aW5jaS1lZHUuZnIiLCJ1cG4iOiJtYXRodXNoYS50aGlydWxvZ2FzaW5nYW1Ac3VwZGV2aW5jaS1lZHUuZnIiLCJ1dGkiOiJTbnNNd3ZBM1praVQ2TkNlUnFFZEFBIiwidmVyIjoiMS4wIiwid2lkcyI6WyJiNzlmYmY0ZC0zZWY5LTQ2ODktODE0My03NmIxOTRlODU1MDkiXSwieG1zX3RjZHQiOjE0Nzk3NDYxNzJ9.bsJs7C9riY4j4WvkDLgemAKf-cALhrU-rP7f49hMO9SJGPy2y0RhKXyOrSRh09hdlKj74pCyYLDmUIzlnKTBKcbsBgLZlqq9M6Ii6gOMDjiY3b2xjTwUpF40omTmefeP3yXyF2c1WoucMGqhr2fV9wttWVYLqLjIY0gflTYexhvbOyWXh2xntsQENmhLYhJkf9eD1XrbsFk6tDsoIUvTrjUUIVpAAhzwBGbu4QxvhvcpWx-LSEi1ksMpXuTFvyWNo0aTujE3vo9qo-IRbQ5uVgQzs3N_mTg_hUsf5oPGs_4js9_UCrn33N0J10BZnh1g3QdZpD7cFF9t5eZkEl-eCg',
        "Accept" : "application/json; charset=utf-8",
        "Content-Type": "application/json; charset=utf-8"
      },
      dataType:"jsonp",
      success: function(data) {
            alert(data);
        },
        error: function() {
            alert('Error occured');
        }
    })  
  });*/
});