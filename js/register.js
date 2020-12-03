
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
