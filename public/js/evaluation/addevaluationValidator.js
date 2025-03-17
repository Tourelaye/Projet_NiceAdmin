document.addEventListener("DOMContentLoaded", function () {
    let etudiantSelect = document.getElementById("etudiant_id");

    // Charger les étudiants dans la liste déroulante
    fetch("../controller/etudiant/EtudiantController.php?action=list")
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                data.forEach(etudiant => {
                    let option = document.createElement("option");
                    option.value = etudiant.id;
                    option.textContent = `${etudiant.nom} ${etudiant.prenom}`;
                    etudiantSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error("Erreur lors du chargement des étudiants :", error));

    // Récupérer les détails d'un étudiant sélectionné
    etudiantSelect.addEventListener("change", function () {
        let etudiantId = this.value;
        if (etudiantId) {
            fetch(`../controller/etudiant/EtudiantController.php?id=${etudiantId}`)
                .then(response => response.json())
                .then(etudiant => {
                    console.log("Étudiant sélectionné :", etudiant);
                    // Ici, tu peux afficher les détails si besoin
                })
                .catch(error => console.error("Erreur lors de la récupération de l'étudiant :", error));
        }
    });
});
