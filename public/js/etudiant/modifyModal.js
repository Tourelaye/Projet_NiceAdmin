<script>
    function fillModifyModal(etudiant) {
        document.getElementById('modify_id').value = etudiant.id;
        document.getElementById('modify_nom').value = etudiant.nom;
        document.getElementById('modify_prenom').value = etudiant.prenom;
        document.getElementById('modify_email').value = etudiant.email;
        document.getElementById('modify_adresse').value = etudiant.adresse;
        document.getElementById('modify_matricule').value = etudiant.matricule;
        document.getElementById('modify_telephone').value = etudiant.telephone;
    }
</script>
