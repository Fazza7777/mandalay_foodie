
      ///edit

      var editAcc = document.querySelectorAll("#editAcc")
      editAcc.forEach(function(e){
          var accId = e.getAttribute("accountId")
          var accName = e.getAttribute("accountName")
          e.addEventListener("click",function(){
            axios.get(`api.php?accEdit&edit_id=${accId}`)
            .then(response=>{
                $("#editModal").modal("show")
                document.getElementById("editName").value=response.data.name
                document.getElementById("editEmail").value=response.data.email
                document.getElementById("id").value=response.data.id
            })
          })
        
      })
      //get edit data
      var updateForm = document.getElementById("my-form")
      var currentUserId = updateForm.getAttribute("curId")
      var currentUserName = updateForm.getAttribute("curName")
      updateForm.addEventListener("submit",function(e){
        e.preventDefault();
        var name = document.getElementById("editName").value
        var email = document.getElementById("editEmail").value
        var id = document.getElementById("id").value
        if(id==0){
          location.href ="login.php"
        }
        if(currentUserId !== id){
          $("#editModal").modal("hide")
           toastr.info(`Hello :: ${currentUserName} - It is not your account!`)
          
        }else{
            if(name == "" || email == ""){
              if(name == ""){
                toastr.success("နာမည် ထည့်ရန်လိုအပ်ပါသည်")
                document.getElementById("nullName").innerHTML = "နာမည် ထည့်ရန်လိုအပ်ပါသည်"
              }
              if(email == ""){
                toastr.success("အီးမေးလ် ထည့်ရန်လိုအပ်ပါသည်")
                document.getElementById("nullEmail").innerHTML = "အီးမေးလ် ထည့်ရန်လိုအပ်ပါသည်"
              }
            }else{
              //  console.log(name+"-"+email)
              var data = new FormData()
              data.append("id",id)
              data.append("currentUserId",currentUserId)
              data.append("username",name)
              data.append("email",email)
              axios.post(`api.php`,data)
              .then(response=>{
                $("#editModal").modal("hide")
                console.log(response.data)
                if(response.data != "already_exist"){
                       toastr.success(` ${name} : Update success!`)
                        document.getElementById("action").innerHTML = response.data
                        setTimeout(go,500)
                        function go(){
                          location.href ="registration.php"
                        }
                }
                if(response.data == "already_exist"){
                  toastr.warning("အီးမေးလ်သည် အသုံးပြုပီးဖြစ်ပါသည်")
                }
              })
            }

        }
        

      })
    //delete
      var deleteAcc = document.querySelectorAll("#deleteAcc")
      deleteAcc.forEach(function(d){
      var accId = d.getAttribute("accountId")
      var accName = d.getAttribute("accountName")
      var adminId = d.getAttribute("adminId")
      if(adminId == 0){
        location.href = "login.php"
      }
      d.addEventListener("click",function(){ 
        if(adminId !== "1"){
          swal("No Permission!", "Admin account only can delete!", "warning")
        }else{
          if(accId ==="1"){
            swal("No Permission!", "Can not delete this Admin account!", "warning")
          }else{
            swal({
              title: `Are you sure Delete? `,
              text:`${accName} Account`,
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {      
                  axios.get(`api.php?accDelete&id=${accId}`)
                  .then(response=>{
                    name = response.data
                    toastr.success(`Account ${accName} : Delete!`)
                    document.getElementById("action").innerHTML = response.data
                    swal("Deleted!", ` ${accName} - has been deleted.`, "success");
                    setTimeout(go,500)   
                    function go(){
                      location.href ="registration.php"
                    }    
                  }) 
                
                }  
            });
          }

        }
      })
    })
