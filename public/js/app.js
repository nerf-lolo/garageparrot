console.log("test connexion");

$(document).ready(function () {
  // Lorsque le formulaire est soumis
  $("#searchForm").submit(function (event) {
    event.preventDefault(); // Empêcher le rechargement de la page

    // Récupére les données du formulaire
    var formData = $(this).serialize();

    // Envoye la requête AJAX au serveur
    $.ajax({
      url: "/car", // L'URL du contrôleur qui traite la recherche
      type: "GET",
      data: formData,
      dataType: "html", // Le type de données attendu en retour
      success: function (data) {
        // Mettre à jour la liste des voitures avec les résultats renvoyés par le serveur
        $("#carsContainer").html(data);
      },
      error: function () {
        // Gérer les erreurs éventuelles
        alert("Une erreur s'est produite lors de la recherche.");
      },
    });
  });
});
