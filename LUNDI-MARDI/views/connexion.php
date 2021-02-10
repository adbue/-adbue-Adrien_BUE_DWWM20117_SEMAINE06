<div class="row justify-content-center">
    <div  class="col-8">
    <div class="card">

        <div class="card-body ">
        <h3 class= card-title> Connexion</h3>
            <?php echo form_open(); ?>

                <div class="Form-group mb-3 px-3">
                    <label for="nom">Identifiant*</label>
                    <input class="form-control" type="text" name="Login" id="login" placeholder="Veuillez saisir votre identifiant" required>

                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('Login'); ?>
                </div>

                <div class="Form-group mb-3 px-3">
                    <label for="nom">Mot de passe*</label>
                    <input class="form-control" type="password" name="Pass" id="pass" placeholder="Veuillez saisir votre mot de passe" required>
                <!-- Espace commentaire Erreur validation -->
                <?php echo form_error('Pass'); ?>
                </div>

                <div class="my-4">
                    <!-- Envoi de notre formulaire vers connexion_valide avec formaction="..."-->
                    <button type="submit" class="btn btn-success" id="bouton_envoi" name="submit">Envoyer</button>
                    <button type="reset" class="btn btn-secondary">Annuler</button>
                </div>

            </form>

        </div>
            </div>
        </div>
    </div>