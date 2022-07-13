<?php

include "../src/config.php";
include "../src/database.php";
?>
<!DOCTYPE HTML>
<html>

<head>
     <title><?php echo SERVICE_NAME ?> | Dashboard</title>
     <meta charset="UTF-8" />
     <meta name="viewport" content="width=device-width, initial-scale=1.0" />
     <link rel="stylesheet" href="../assets/css/dash.css">

     <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


     <!--mdbootstrap stuff-->
     <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" rel="stylesheet" />
     <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
     <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.css" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.3.0/mdb.min.js"></script>

     <script>
          window.onload = async () => {
               const resp = await axios.get('https://<?php echo DOMAIN ?>/domains/list')
               this.domains = resp.data.domains

               const listElement = document.getElementById('selectionBox')

               domains.forEach(domain => {
                    const newElement = document.createElement('option')
                    newElement.id = domain.name
                    newElement.innerHTML = domain.name
                    newElement.className = "bg-dark"
                    newElement.value = domains.indexOf(domain)

                    listElement.appendChild(newElement)
               })
          }
     </script>

</head>

<body>

     <nav class="navbar navbar-expand-lg text-light">
          <div class="container">
               <span class="navbar-brand mb-0 h1">ShareX Uploader</span>
               <button class="navbar-toggler" type="button" data-mdb-toggle="collapse"
                    data-mdb-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
               </button>
               <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav ms-auto">
                         <a class="nav-link col-md-4 link-white" href="">profile</a>
                         <a class="nav-link col-md-4 link-white" href="">images</a>
                         <a class="nav-link col-md-4 link-white" href="">paste</a>
                         <a class="nav-link col-md-4 link-white" href="">logout</a>
                    </div>
               </div>
          </div>
     </nav>


     <div class="container mt-5">

          <div class="card text-white bg-blur my-3">
               <div class="card-header">Upload settings</div>
               <div class="card-body">
                    <form class="text-center">

                         <div class="form-outline form-white mb-2">
                              <input type="text" id="subdomainText" class="form-control" />
                              <label class="form-label" for="form1Text1">Subdomain</label>
                         </div>

                         <select id="selectionBox" class="form-select text-white bg-blur mb-4"
                              aria-label="Default select example">
                              <option class="bg-dark" selected>Choose a domain</option>
                         </select>

                         <button onclick="if (!window.__cfRLUnblockHandlers) return false; handleSave()" id="saveButton"
                              type="button" class="btn btn-lg btn-primary"
                              data-cf-modified-0031b96d8dcda876e9f76fb2-="">save</button>

                    </form>
               </div>


          </div>


          <div class="card text-white bg-blur my-3">
               <div class="card-header">Embed settings</div>
               <div class="card-body">
                    <form class="text-center">

                         <div class="d-flex justify-content-center mb-4">
                              <div class="d-flex gap-3 ">

                                   <div class="form-check form-switch">
                                        <input
                                             onclick="if (!window.__cfRLUnblockHandlers) return false; handleEmbedTick()"
                                             class="form-check-input" type="checkbox" id="embedEnabledTickbox"
                                             data-cf-modified-0031b96d8dcda876e9f76fb2-="" />
                                        <label class="form-check-label" for="embedEnabledTickbox">Enable Embeds</label>
                                   </div>

                              </div>
                         </div>

                         <button type="button" class="btn btn-lg btn-primary" data-mdb-toggle="modal"
                              data-mdb-target="#embeds">Configure</button>

                    </form>
               </div>


          </div>


          <div class="card text-white bg-blur text-center my-3">
               <div class="card-body">
                    <h3 class="card-title">ShareX Key</h3>
                    <h3 id="keyTitle" class="card-title blurredtext">PRthu3EY8xC6t7gc</h3>
                    <button onclick="if (!window.__cfRLUnblockHandlers) return false; downloadConfig()"
                         class="btn btn-lg btn-primary" type="button"
                         data-cf-modified-0031b96d8dcda876e9f76fb2-="">Download Config</button>
               </div>
          </div>

          <div class="modal fade" id="embeds" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
               <div class="modal-dialog">
                    <div class="modal-content text-white bg-dark">
                         <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">Embed Settings</h5>
                              <button type="button" class="btn-close" data-mdb-dismiss="modal"
                                   aria-label="Close"></button>
                         </div><br>
                         <div class="form-outline form-white mb-2">
                              <input type="text" id="embedTitleField" class="form-control" />
                              <label class="form-label" for="embedTitleField">title</label>
                         </div>

                         <div class="form-outline form-white mb-2">
                              <input type="text" id="embedDescriptionField" class="form-control" />
                              <label class="form-label" for="embedDescriptionField">description</label>
                         </div>

                         <div class="form-outline form-white mb-2">
                              <input type="text" id="embedAuthorField" class="form-control" />
                              <label class="form-label" for="embedAuthorField">author</label>
                         </div>

                         <div class="form-outline form-white mb-2">
                              <input type="text" id="embedSiteNameField" class="form-control" />
                              <label class="form-label" for="embedSiteNameField">site name</label>
                         </div>

                         <div class="form-outline form-white mb-2">
                              <p1 class="form-control">color</p1>
                              <input type="color" id="embedColorField" class="form-control" style="height: 3em" />
                         </div>

                         <button onclick="if (!window.__cfRLUnblockHandlers) return false; saveEmbed()"
                              class="btn btn-lg btn-secondary " type="button" data-mdb-dismiss="modal"
                              data-cf-modified-0031b96d8dcda876e9f76fb2-="">Save</button>
                    </div>
               </div>
          </div>


     </div>
     <script src="../assets/js/loader.js" defer=""></script>
</body>

</html>