<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="../styles/js/dash.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<script>
    $(document).ready(function () {
        $('#records-limit').change(function () {
            $('form').submit();
        })
    });
    
  function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function SearchBySup() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("inputSup");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

// Function calcule totale avance
function Reste() {
  // Declare variables
  var avance, remise;
  avance = document.getElementById("avance").value;
  remise = document.getElementById("remise").value;
  reste = parseFloat(remise - avance);

  if(avance == 0) document.getElementById("reste").value = remise;
  
  else document.getElementById("reste").value = reste;
  

  console.log(reste);
  
}

function ResteAvance() {
  // Declare variables 
  var avance, reste, new_avance, newAvance;
  avance = document.getElementById("avance").value;
  reste = document.getElementById("reste").value;
  new_avance = document.getElementById("new_avance").value;

  document.getElementById("new_avance").value = 0;

  resteAvance = parseFloat(reste)-parseFloat(avance);
  newAvance = parseFloat(new_avance)+parseFloat(avance);

  if(avance == 0){
    document.getElementById("reste_avance").value = reste;
    document.getElementById("new_avance").value = new_avance;
  }
  else{
    document.getElementById("reste_avance").value = resteAvance;
    document.getElementById("new_avance").value = newAvance;
  }

  console.log(resteAvance);
  console.log(newAvance);
  
}



// function printPdf
function printPdf() {
  const invoice = document.getElementById("container_print_pdf");
  console.log(invoice);
  html2pdf().from(invoice).save();
}

function NowDate(){
  var d = new Date,
    dformat = [d.getMonth()+1,
    d.getDate(),
    d.getFullYear()].join('/')+' '+
    [d.getHours(),
    d.getMinutes(),
    d.getSeconds()].join(':');

    return d;
}


   let supprimer = document.getElementsByClassName("supprime")[0];
    
      function suppr(event) {
              let id = event.target.className;
              supprimer.href = `delete.php?id-boat=${id}`;
     }
     let sup = document.getElementsByClassName("supp")[0];
       function supprSup(event) {
              let id = event.target.className;
              sup.href = `delete.php?id-sup=${id}`;
     }
    
     let serv = document.getElementsByClassName("serv")[0];
       function supprServ(event) {
              let id = event.target.className;
              serv.href = `delete.php?id-service=${id}`;
     }
     let plang = document.getElementsByClassName("plang")[0];
       function supprPlang(event) {
              let id = event.target.className;
              plang.href = `delete.php?id-plangeur=${id}`;
     }
     let mission = document.getElementsByClassName("miss")[0];
       function supprMiss(event) {
              let id = event.target.className;
              mission.href = `delete.php?id-mission=${id}`;
     }
     
     let tache = document.getElementsByClassName("tache")[0];
       function supprTache(event) {
              let id = event.target.className;
              let myArray = id.split(" ");
              let idtache = myArray.shift();
              let idmission = myArray.pop();
               tache.href = `delete.php?id-tache=${idtache}&id-mission=${idmission}`;
     }

</script>

