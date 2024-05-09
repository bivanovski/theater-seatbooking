$("#menu-toggle").on("click", function (e) {
  e.preventDefault();
  $("#wrapper").toggleClass("menuDisplayed");
});
function getShows() {
  $.ajax({
    url: "Services/show_get.php",
    type: "GET",
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#showCards").empty();

        $.each(response.data, function (index, show) {
          var cardHtml = `
                <div class="col-md-3 mb-5">
                    <a href="show_details.php?id=${show.id}" class="card-link">
                        <div class="card text-dark shadow-sm shows" data-show-id="${show.id}">
                            <img src="${show.image}" class="card-img-top" alt="${show.name}">
                            <div class="card-body">
                                <h5 class="card-title accent-color">${show.name}</h5>
                                <div class="d-flex justify-content-between">
                                    <p class="card-text">Genre: ${show.genre}</p>
                                    <p class="card-text primary-color">${show.age_group}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            `;
          $("#showCards").append(cardHtml);
        });
      } else {
        console.error("Failed to fetch shows");
      }
    },
    error: function (xhr, status, error) {
      console.error("Error fetching shows:", error);
    },
  });
}

function getShow(showId) {
  $.ajax({
    url: "Services/show_details.php",
    method: "GET",
    data: { show_id: showId },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#show_id").val(response.data.id);
        $("#name").val(response.data.name);
        $("#hall_number").val(response.data.hall_number);
        $("#description").val(response.data.description);
        $("#genre_id").val(response.data.genre_id);
        $("#age_group").val(response.data.age_group);
        $("#director").val(response.data.director);
        $("#assistant_director").val(response.data.assistant_director);
        $("#costume_designer").val(response.data.costum_designer);
        $("#stage_manager").val(response.data.stage_manager);
        $("#set_designer").val(response.data.set_designer);
        $("#image").val(response.data.image);
      } else {
        // Handle error
        console.error("Failed to load show details:", response.message);
      }
    },
    error: function (xhr, status, error) {
      // Handle error
      console.error("Error loading show details:", error);
    },
  });
}

function loadShowDetails(showId) {
  $.ajax({
    url: "Services/show_details.php",
    method: "GET",
    data: { show_id: showId },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        var showData = response.data;
        $("#show-details-container").html(`
                    
                    <div class="row mb-3">
<div class="col-md-3">
<img src="${showData.image}" class="shadow-sm img-fluid" alt="Show Image">
</div>
<div class="col-md-9">
<div class="row">
<div class="col d-flex justify-content-between">
    <h3 class="accent-color">${showData.name}</h3>
    <div class="">
        <a class="btn text-warning p-0 mr-1" href="show_edit.php?id=${showData.id}"><i class="fa-regular fa-pen-to-square fa-lg"></i></a>
        <button class="btn accent-color p-0 delete-show-btn"><i class="fa-regular fa-trash-can fa-lg"></i></button>
    </div>
</div>
</div>
<h4 class="text-warning  mb-4">${showData.age_group}</h4>
<h4 class="text-dark">Description:</h4>
<p class="text-dark text-justify">${showData.description}</p>
<h5 class="text-dark">Genre: <span class="accent-color">${showData.genre}</span></h5>
<h6 class="text-dark mb-4">Hall Number: <span class="accent-color">${showData.hall_number}</span></h6>
<h4 class="text-dark">Production Crew:</h4>
<div class="row">
<div class="col-md-6">
    <div class="crew-member">
        <h5 class="text-dark mb-0">Director:</h5>
        <p class="accent-color">${showData.director}</p>
    </div>
    <div class="crew-member">
        <h5 class="text-dark mb-0">Assistant Director:</h5>
        <p class="accent-color">${showData.assistant_director}</p>
    </div>
    <div class="crew-member">
        <h5 class="text-dark mb-0">Costume Designer:</h5>
        <p class="accent-color">${showData.costum_designer}</p>
    </div>
</div>
<div class="col-md-6">
    <div class="crew-member">
        <h5 class="text-dark mb-0">Set Designer:</h5>
        <p class="accent-color">${showData.set_designer}</p>
    </div>
    <div class="crew-member">
        <h5 class="text-dark mb-0">Stage Manager:</h5>
        <p class="accent-color">${showData.stage_manager}</p>
    </div>
</div>
</div>
</div>
</div>

</div>
                
<div class="row">
<div class="col-10">
<h4 class="text-dark">Repertoires:</h4>
<button type="button" class="btn btn-primary btn-sm mb-3" data-toggle="modal" data-target="#RepertoireModal">
<i class="fa-solid fa-plus mr-1"></i>Add New Repertoire</button>

<div id="repertoire-container"></div>
</div>
</div>
                `);
      } else {
        $("#show-details-container").html(
          `<p class="text-danger">${response.message}</p>`
        );
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      $("#show-details-container").html(
        `<p class="text-danger">Failed to load show details. Please try again later.</p>`
      );
    },
  });
}
function loadRepertoires(showId) {
  $.ajax({
    url: "Services/repertoire_get_by_show.php",
    method: "GET",
    data: { show_id: showId },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        var repertoires = response.data;
        var repertoireHtml = "";
        repertoires.forEach(function (repertoire) {
          var dateTime = new Date(repertoire.date_time);
          var formattedDateTime = dateTime.toLocaleString("en-GB", {
            year: "numeric",
            month: "2-digit",
            day: "2-digit",
            hour: "2-digit",
            minute: "2-digit",
          });
          repertoireHtml += `<button type="button" class="btn btn-outline-danger custom-outline-btn mr-2" data-repertoire-id="${repertoire.id}">${formattedDateTime}</button>`;
        });
        $("#repertoire-container").html(repertoireHtml);
      } else {
        $("#repertoire-container").html(
          `<p class="text-danger">${response.message}</p>`
        );
      }
    },
    error: function (xhr, status, error) {
      console.error(xhr.responseText);
      $("#repertoire-container").html(
        `<p class="text-danger">Failed to load repertoires. Please try again later.</p>`
      );
    },
  });
}
function getRepertoire(id) {
  $.ajax({
    url: "Services/repertoire_get.php",
    method: "GET",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        $("#show_id").val(response.data.id);
        $("#name").val(response.data.name);
        $("#hall_number").val(response.data.hall_number);
        $("#description").val(response.data.description);
        $("#genre_id").val(response.data.genre_id);
        $("#age_group").val(response.data.age_group);
        $("#director").val(response.data.director);
        $("#assistant_director").val(response.data.assistant_director);
        $("#costume_designer").val(response.data.costume_designer);
        $("#stage_manager").val(response.data.stage_manager);
        $("#set_designer").val(response.data.set_designer);
        $("#image").val(response.data.image);
      } else {
        // Handle error
        console.error("Failed to load show details:", response.message);
      }
    },
    error: function (xhr, status, error) {
      // Handle error
      console.error("Error loading show details:", error);
    },
  });
  function addRepertoire(showId, dateTime) {
    $.ajax({
      url: "Services/repertoire_add.php",
      method: "POST",
      data: { 
        show_id: showId,
        date_time: dateTime
      },
      dataType: "json",
      success: function (response) {
        if (response.success) {
          // Handle success
          console.log("Repertoire added successfully");
        } else {
          // Handle failure
          console.error("Failed to add repertoire:", response.message);
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        console.error("Error adding repertoire:", error);
      }
    });

    function editRepertoire(id, showId, dateTime) {
      $.ajax({
          url: "Services/repertoire_update.php",
          method: "POST",
          data: {
              id: id,
              show_id: showId,
              date_time: dateTime
          },
          dataType: "json",
          success: function (response) {
              if (response.success) {
                  // Repertoire updated successfully
                  console.log(response.message);
                  // Optionally, you can perform additional actions here, such as updating the UI
              } else {
                  // Failed to update repertoire
                  console.error(response.message);
                  // Optionally, you can display an error message or take other actions
              }
          },
          error: function (xhr, status, error) {
              // Handle error
              console.error("Error updating repertoire:", error);
              // Optionally, you can display an error message or take other actions
          }
      });
  }
  
  }
  
}
