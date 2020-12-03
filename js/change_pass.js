  // Change password

  var pass_change = document.querySelector("#pass_change") 
  pass_change.addEventListener("click",function(){
      $("#passchange").modal('show')
  }) 
  var updateForm = document.getElementById("my-form")
  var currentUserId = updateForm.getAttribute("curId")
  var currentUserName = updateForm.getAttribute("curName")
  var currentOldPass = updateForm.getAttribute("oldPass")
  // alert(currentOldPass)
  updateForm.addEventListener("submit",function(e){
    e.preventDefault();
    var oldPass = document.getElementById("oldPassword").value
    var newPass = document.getElementById("newPassword").value
    var cnewPass = document.getElementById("cnewPassword").value
   
    if(currentUserId==null){
      location.href ="login.php"
    }else{
        if(oldPass == "" || newPass == "" || cnewPass == "" || newPass.length<6 || newPass != cnewPass){
          if(oldPass == ""){
            toastr.success("စကားဝှက်အဟောင်း ထည့်ရန်လိုအပ်ပါသည်")
            document.getElementById("oPass").innerHTML = "စကားဝှက်အဟောင်း ထည့်ရန်လိုအပ်ပါသည်"
           document.getElementById("oldPassword").classList.add("border-danger")
           setTimeout(function(){
            document.getElementById("oPass").innerHTML = ""
            document.getElementById("oldPassword").classList.remove("border-danger")
           },1000)
        
          }
          if(newPass == ""){
            toastr.success("စကားဝှက်အသစ် ထည့်ရန်လိုအပ်ပါသည်")
            document.getElementById("nPass").innerHTML = "စကားဝှက်အသစ် ထည့်ရန်လိုအပ်ပါသည်"
            document.getElementById("newPassword").classList.add("border-danger")
            setTimeout(function(){
              document.getElementById("nPass").innerHTML = ""
              document.getElementById("newPassword").classList.remove("border-danger")
            },1000)
          }
          if(cnewPass == ""){
            toastr.success("အတည်ပြု စကားဝှက်အသစ် ထည့်ရန်လိုအပ်ပါသည်")
            document.getElementById("cnPass").innerHTML = "အတည်ပြု စကားဝှက်အသစ် ထည့်ရန်လိုအပ်ပါသည်"
            var cnewPass = document.getElementById("cnewPassword").classList.add("border-danger")
            setTimeout(function(){
              document.getElementById("cnPass").innerHTML = ""
              document.getElementById("cnewPassword").classList.remove("border-danger")
             },1000)
          }
          if(newPass.length<6){
            toastr.success("စကားဝှက်အသစ် သည်အနည်းဆုံး ၆လုံး ထည့်ရန်လိုအပ်ပါသည်")
            document.getElementById("nPass").innerHTML = "စကားဝှက်အသစ် သည်အနည်းဆုံး ၆လုံး ထည့်ရန်လိုအပ်ပါသည်"
            document.getElementById("newPassword").classList.add("border-danger")
            setTimeout(function(){
              document.getElementById("nPass").innerHTML = ""
              document.getElementById("newPassword").classList.remove("border-danger")
            },1000)
           }else{
              if(newPass!= cnewPass){
                toastr.success("စကားဝှက်အသစ်များတူညီရန်လိုအပ်ပါသည်")
                document.getElementById("cnPass").innerHTML = "စကားဝှက်အသစ်များတူညီရန်လိုအပ်ပါသည်"
                document.getElementById("cnewPassword").classList.add("border-danger")
                setTimeout(function(){
                  document.getElementById("cnPass").innerHTML = ""
                  document.getElementById("cnewPassword").classList.remove("border-danger")
                 },1000)
              }
           }
          
        }else{

          var data = new FormData()
          data.append("currentUserId",currentUserId)
          data.append("currentold_password",currentOldPass)
          data.append("old_password",oldPass)
          data.append("new_password",newPass)
          data.append("cnew_password",cnewPass)
          axios.post("api.php",data)
          .then(response=>{
            // $("#editModal").modal("hide")
            console.log(response.data)
            if(response.data == "incorrect"){
              toastr.success("စကားဝှက်အဟောင်း မှားနေပါသည်")
              document.getElementById("oPass").innerHTML = "စကားဝှက်အဟောင်း မှားနေပါသည်"
             document.getElementById("oldPassword").classList.add("border-danger")
             setTimeout(function(){
              document.getElementById("oPass").innerHTML = ""
              document.getElementById("oldPassword").classList.remove("border-danger")
             },1000)
            }
            if(response.data == "success"){
               document.getElementById("oldPassword").value=""
              document.getElementById("newPassword").value=""
              document.getElementById("cnewPassword").value=""
              $("#passchange").modal('hide')
              toastr.info(`${currentUserName} စကားဝှက်ပြောင်းခြင်း အောင်မြင်ပါသည်`)
            }

           })
        }

    }
    

  })