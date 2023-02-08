		<header>
			<div class="container">
				<div class="slider-container">
					<div class="intro-text">
						<div class="intro-lead-in">Bem-vindo a Cemerge!</div>
						<div class="intro-heading">Prazer em nos conectar!!!</div>
					</div>
				</div>
			</div>
		</header>
		<section id="about" class="light-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<h2 style="text-shadow: 0.1em 0.1em 0.1em #d3d3d3; font-weight:bold">Quem somos?</h2>
							<p>A Cooperativa de Trabalho dos Médicos Emergencistas do Ceará Ltda. – CEMERGE, fundada em 1998, nasceu do desejo de um grupo de médicos para lutar por uma remuneração mais justa e promover o desenvolvimento técnico científico nas unidades de emergência.</p> 
							<p>Grandes, intensas e difíceis foram as inúmeras lutas que tivemos durante todos esses anos. Resistências e injustiças foram enfrentadas com coragem e altivez. Em certo momento da história desejaram colocar nas cooperativas a culpa pelas dificuldades e fragilidades do sistema de saúde. A CEMERGE, com o vigor que lhe é característico sempre rechaçou tal iniciativa.</p>
						</div>
					</div>
				</div>
			</div>
			<!-- /.container -->
		</section>
		<section class="light-bg" style="background-color:#00a65a">
			<div class="container text-center">
				<div class="row">
					<div class="col-md-3 mb-sm-30">
						<div class="counter-item">
							<h2 data-count="3">6</h2>
							<h6>Hospitais Conveniados</h6>
						</div>
					</div>
					<div class="col-md-3 mb-sm-30">
						<div class="counter-item">
							<h2 data-count="4682">4682</h2>
							<h6>Cooperados cadastrados</h6>
						</div>
					</div>
					<div class="col-md-3 mb-sm-30">
						<div class="counter-item">
							<h2 data-count="7560">7560</h2>
							<h6>Plantões por mês</h6>
						</div>
					</div>
					<div class="col-md-3 mb-sm-30">
						<div class="counter-item">
							<h2 data-count="78">78</h2>
							<h6>Setores</h6>
						</div>
					</div>
				</div>
			</div>
		</section>
		<section id="hospital" class="light-bg">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<div class="section-title">
							<h2 style="text-shadow: 0.1em 0.1em 0.1em #d3d3d3; font-weight:bold">Hospitais Conveniados</h2>
							<p>Temos convênios com os grandes hospitais de Fortaleza e Região Metropolitana.</p>
						</div>
					</div>
				</div>

				<div class="row">
					<?php
					if (!empty($hospital)) {
						foreach ($hospital as $hospital) { ?>
							<div class="col-md-3">
								<a href="#" data-toggle="modal" data-target="#hospital_<?=$hospital["id"]?>">
									<div class="ot-hospital-item">
										<figure class="effect-bubba">
											<img src="<?=base_url().$hospital["img"]?>" alt="img02" class="img-responsive"/>
										</figure>
										<div class="team-text">
											<center><h3><b><?=$hospital["nome"]?></h3></center>
										</div>
									</div>
								</a>
							</div>

							<div class="modal fade" id="hospital_<?=$hospital["id"]?>" tabindex="-1" role="dialog" aria-labelledby="Modal-label-1">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
									
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="X"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="Modal-label-1"><b><?=$hospital["nome"]?></h4>
										</div>
									
										<div class="modal-body">
											<img src="<?=base_url().$hospital["img"]?>" alt="img01" class="img-responsive"/>
											<div class="modal-works"></div>
											<center><p><h4><?=$hospital["descricao"]?></h4></p></center>
										</div>

										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
										</div>
									</div>
								</div>
							</div>
					<?php }
					} ?>
				</div>
			</section>
			<section id="time" class="light-bg">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="section-title">
								<h2 style="text-shadow: 0.1em 0.1em 0.1em #d3d3d3; font-weight:bold">Nossa Equipe</h2>
								<p>Conheça nossa Equipe</p>
							</div>
						</div>
					</div>
					<div class="row">
						<?php 
						if (!empty($time)) {
							foreach ($time as $membro) { ?>

							<div class="col-md-3">
								<a href="#" data-toggle="modal" data-target="#membro_<?=$membro["membro_id"]?>">
									<div class="time-item">
										<div class="time-image">
											<img src="<?=base_url().$membro["membro_foto"]?>" class="img-responsive" alt="author">
										</div>
										<div class="team-text">
											<h3><?=$membro["membro_nome"]?></h3>
										</div>
									</div>
								</a>
							</div>

							<div class="modal fade" id="membro_<?=$membro["membro_id"]?>" tabindex="-1" role="dialog" aria-labelledby="Modal-label-1">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="Modal-label-1"><?=$membro["membro_nome"]?></h4>
										</div>
										
										<div class="modal-body">
											<img src="<?=base_url().$membro["membro_foto"]?>" alt="img01" class="img-responsive center-block" />
											<center><p><?=$membro["membro_descricao"]?></p></center>
										</div>
										
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
										</div>
									</div>
								</div>
							</div>
						<?php } // FOREACH
						} // IF ?>
					</div>
				</div>
			</section>
			<section id="comunicados" class="light-bg">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="section-title">
								<h2 style="text-shadow: 0.1em 0.1em 0.1em #d3d3d3; font-weight:bold">Comunicados</h2>
								<p></p>
							</div>
						</div>
					</div>
					<div class="row">
						<?php 
						if (!empty($comunicado)) {
							foreach ($comunicado as $comunicado) { ?>

							<div class="col-md-4">
								<a href="#" data-toggle="modal" data-target="#comunicado_<?=$comunicado["id"]?>">
									<div class="comunicado-item">
										<div class="comunicado-image">
											<img src="<?=base_url().$comunicado["img"]?>" class="img-responsive" alt="author">
										</div>
										<div class="team-text">
											<center><h3><?=$comunicado["nome"]?></h3></center>
										</div>
									</div>
								</a>
							</div>
							<div class="modal fade" id="comunicado_<?=$comunicado["id"]?>" tabindex="-1" role="dialog" aria-labelledby="Modal-label-1">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<h4 class="modal-title" id="Modal-label-1"><?=$comunicado["nome"]?></h4>
										</div>
										
										<div class="modal-body">
											<img src="<?=base_url().$comunicado["img"]?>" alt="img01" class="img-responsive center-block" />
											<center><p><?=$comunicado["descricao"]?></p></center>
										</div>
										
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
										</div>
									</div>
								</div>
							</div>
						<?php } // FOREACH
						} // IF ?>
					</div>
				</div>
			</section>
			<section id="contact">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center">
							<div class="section-title">
								<h2>Entre em contato conosco</h2>
								<p>Estaremos de plantão para atendê-los o mais breve possível!!!</p>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-center">
							<h3>Nossa Sede</h3>
							<p>Rua Costa Barros, 2422</p>
							<div><iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.350701131256!2d-38.504445084722235!3d-3.733520744245314!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c748610a640001%3A0x5a129694e898cc39!2sCEMERGE!5e0!3m2!1spt-BR!2sbr!4v1673368147681!5m2!1spt-BR!2sbr" width="250" height="100" style="border:1px solid #00a65a;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></div>
						</div>
						<div class="col-md-6 text-center">
							<h3>Atendimentos</h3>
							<p><i class="fa fa-clock-o"></i> <span class="day">Segunda à Sexta:</span><span> 08:00 às 17:00 hs</span></p>
							<p><i class="fa fa-phone"></i> (85) 3244-1704</p>
							<p><a target="_blank" href="https://wa.me/5585996213774?text=Sac%3A%20" style="color:#00a65a"><i class="fa fa-whatsapp"></i> (85) 996213774</a></p>
							<p><i class="fa fa-envelope"></i> gerenciasac@cemerge.com.br</p>
						</div>
						<!--<div class="col-md-6">
							<form class="row needs-validation" name="sentMessage" id="form-contato">
								<div class="row">
									<div class="col-md-6">
										<div class="form-group">
											<input type="text" class="form-control is-invalid" placeholder="Nome *" id="name">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<input type="email" class="form-control is-valid" placeholder="Email *" id="email">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<textarea class="form-control is-valid" placeholder="Escreva uma mensagem *" id="message"></textarea>
										</div>
									</div>
									<div class="clearfix"></div>
								</div>
								<div class="row">
									<div class="col-lg-12 text-center">
										<div id="success"></div>
										<button type="submit" class="btn btn-flat" style="color:#00a65a;">Enviar</button>
									</div>
								</div>
								<center><div class="alert alert-danger hidden">
			                        Preencha o campo <span id="campo-erro"></span>!!!
			                    </div></center>
							</form>
						</div>-->
					</div>
				</div>

				<script src="<?php echo base_url(); ?>public/js/jquery-3.6.3.slim.min.js"></script>
				<script src="<?php echo base_url(); ?>public/js/bootstrap.min.js"></script>
				<script src="<?php echo base_url(); ?>public/js/contato.js"></script>
			</section>
		<!--<p id="back-top">
			<a href="<?php echo base_url(); ?>#top"><i class="fa fa-angle-up"></i></a>
		</p>-->