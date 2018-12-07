<div class="row">
                <?php 
                    while($ligne_competence=$une_competence_print->fetch()) {
                ?>
                <div class="col-sm-6">
                    <h3 class="text-left text-info"><?php echo $ligne_competence['competence'] ?></h3>
                </div>
                <div class="col-sm-6">
                    <h6 class="text-right text-white"><?php echo $ligne_competence['niveau'] ?></h6>
                    <div class="progress">
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ligne_competence['niveau'] ?>%">
                            <span class="sr-only">40% effectué (success)</span>
                        </div>
                    </div> 
                </div>
                <?php 
                    }
                ?>
            </div> 











            <?php 
                    while($ligne_competence=$une_competence_web->fetch()) {
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <h3 class="text-left  text-info"><?php echo $ligne_competence['competence']; ?></h3>
                    </div>
                    <div class="col-sm-6">
                        <h6 class="text-right text-white"><?php echo $ligne_competence['niveau']; ?></h6>
                        <div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $ligne_competence['niveau']; ?>%">
                            <span class="sr-only">40% effectué (success)</span>
                        </div>
                    </div>
                </div>
                <?php 
                    }
                ?>