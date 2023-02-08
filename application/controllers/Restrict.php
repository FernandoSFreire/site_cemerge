<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Restrict extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library("session");
    }

    public function index()
    {
        if ($this->session->userdata("id")) {
            $data = array(
                "styles" => array (
                    "dataTables.bootstrap.min.css",
                    "dataTables.min.css"
                ),
                "scripts" => array(
                    "sweetalert2.all.min.js",
                    "dataTables.bootstrap.min.js",
                    "dataTables.min.js",
                    "util.js",
                    "restrict.js"
                ),
				"id" => $this->session->userdata("id")
            );
            $this->template->show("restrict.php", $data);
        } else {
            $data = array(
                "scripts" => array(
                    "util.js",
                    "login.js"
                )
            );
            $this->template->show("login.php", $data);
        }
    }

    public function logoff() {
        $this->session->sess_destroy();
        header("Location: " . base_url() . "restrict");
    }

    public function ajax_login()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $username = $this->input->post("username");
        $password = $this->input->post("password");

        if (empty($username)) {
            $json["status"] = 0;
            $json["error_list"]["#username"] = "Usuário não pode ser vazio!";
        } else {
            $this->load->model("usuario_model");
            $result = $this->usuario_model->get_user_data($username);
            if ($result) {
                $id = $result->id;
                $password = $result->password;
                if (password_verify($password, $password)) {
                    $this->session->set_userdata("id", $id);
                } else {
                    $json["status"] = 0;
                }
            } else {
                $json["status"] = 0;
            }
            if ($json["status"] == 0) {
                $json["error_list"]["#btn_login"] = "Usuário e/ou senha incorretos!";
            }
        }

        echo json_encode($json);
    }

    public function ajax_import_image()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $config["upload_path"] = "./tmp/";
        $config["allowed_types"] = "gif|png|jpg";
        $config["overwrite"] = true;

        $this->load->library("upload", $config);

        $json = array();
        $json["status"] = 1;

        if (!$this->upload->do_upload("image_file")) {
            $json["status"] = 0;
            $json["error"] = $this->upload->display_errors("","");
        } else {
            if ($this->upload->data()["file_size"] <= 1024) {
                $file_name = $this->upload->data()["file_name"];
                $json["img_path"] = base_url() . "tmp/" . $file_name;
            } else {
                $json["status"] = 0;
                $json["error"] = "Arquivo não deve ser maior que 1MB!";
            }
        }
        echo json_encode($json);
    }

    public function ajax_save_hospitais()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $this->load->model("hospital_model");

        $data = $this->input->post();

        if (empty($data["nome"])) {
            $json["error_list"]["#nome"] = "Nome do Hospital é obrigatório!";
        } else {
            if ($this->hospital_model->is_duplicated("nome", $data["nome"], $data["id"])){
                $json["error_list"]["#nome"] = "Nome do hospital já existe!";
            }
        }

        if (!empty($json["error_list"])) {
            $json["status"] = 0;
        } else {

            if (!empty($data["img"])) {
                $file_name = basename($data["img"]);
                $old_path = getcwd() . "/tmp/" . $file_name;
                $new_path = getcwd() . "/public/images/hospitais/" . $file_name;
                rename($old_path, $new_path);

                $data["img"] = "/public/images/hospitais/" . $file_name;
            } else {
                unset($data["img"]);
            }

            if (empty($data["id"])) {
                $this->hospital_model->insert($data);
            } else {
                $id = $data["id"];
                unset($data["id"]);
                $this->hospital_model->insert($id, $data);
            }
        }

        echo json_encode($json);
    }

    public function ajax_save_membro()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $this->load->model("time_model");

        $data = $this->input->post();

        if (empty($data["membro_nome"])) {
            $json["error_list"]["#membro_nome"] = "Nome do membro é obrigatório!";
        } 

        if (!empty($json["error_list"])) {
            $json["status"] = 0;
        } else {

            if (!empty($data["membro_foto"])) {
                $file_name = basename($data["membro_foto"]);
                $old_path = getcwd() . "/tmp/" . $file_name;
                $new_path = getcwd() . "/public/images/time/" . $file_name;
                rename($old_path, $new_path);

                $data["membro_foto"] = "/public/images/time/" . $file_name;
            } 

            if (empty($data["membro_id"])) {
                $this->time_model->insert($data);
            } else {
                $membro_id = $data["membro_id"];
                unset($data["membro_id"]);
                $this->time_model->insert($membro_id, $data);
            }
        }

        echo json_encode($json);
    }

    public function ajax_save_usuario()
    {

        if (!$this->input->is_ajax_request()) {
            exit("Nenhum acesso de script direto permitido!");
        }

        $json = array();
        $json["status"] = 1;
        $json["error_list"] = array();

        $this->load->model("usuario_model");

        $data = $this->input->post();

        if (empty($data["username"])) {
            $json['error_list']['#username'] = "Nome é obrigatório!";
        }
        
        if (empty($data["email"])) {
            $json["error_list"]["#email"] = "Email é obrigatório!";
        } else {
            if ($this->usuario_model->is_duplicated("email", $data["email"], $data["id"])){
                $json["error_list"]["#email"] = "Email já existente!";
            } else {
                if ($data["email"] != $data["email_confirm"]) {
                    $json["error_list"]["#email"] = "";
                    $json["error_list"]["#email_confirm"] = "Emails não conferem!";
                }
            }
        }

        if (empty($data["password"])) {
            $json["error_list"]["#password"] = "Senha é obrigatório!";
        } else {
            if ($data["password"] != $data["password_confirm"]) {
                $json["error_list"]["#password"] = "";
                $json["error_list"]["#password_confirm"] = "Senhas não conferem!";
            }
        }

		if (!empty($json["error_list"])) {
			$json["status"] = 0;
		} else {

			$data["password"] = password_hash($data["password"], PASSWORD_DEFAULT);

			unset($data["password"]);
			unset($data["password_confirm"]);
			unset($data["email_confirm"]);

			if (empty($data["id"])) {
				$this->usuario_model->insert($data);
			} else {
				$user_id = $data["user_id"];
				unset($data["user_id"]);
				$this->usuario_model->update($user_id, $data);
			}
		}

		echo json_encode($json);
	}

    public function ajax_get_hospitais_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("hospital_model");

		$id = $this->input->post("id");
		$data = $this->hospital_model->get_data($id)->result_array()[0];
		$json["input"]["id"] = $data["id"];
		$json["input"]["nome"] = $data["nome"];
		$json["input"]["descricao"] = $data["descricao"];

		$json["img"]["img_path"] = base_url() . $data["img"];

		echo json_encode($json);
	}

	public function ajax_get_membro_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("time_model");

		$membro_id = $this->input->post("membro_id");
		$data = $this->time_model->get_data($membro_id)->result_array()[0];
		$json["input"]["membro_id"] = $data["membro_id"];
		$json["input"]["membro_nome"] = $data["membro_nome"];
		$json["input"]["membro_descricao"] = $data["membro_descricao"];

		$json["img"]["membro_foto_path"] = base_url() . $data["membro_foto"];

		echo json_encode($json);
	}

	public function ajax_get_user_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;
		$json["input"] = array();

		$this->load->model("usuario_model");

		$id = $this->input->post("id");
		$data = $this->usuario_model->get_data($id)->result_array()[0];
		$json["input"]["id"] = $data["id"];
		$json["input"]["username"] = $data["username"];
		$json["input"]["email"] = $data["email"];
		$json["input"]["email_confirm"] = $data["email"];
		$json["input"]["password"] = $data["password"];
		$json["input"]["password_confirm"] = $data["password"];

		echo json_encode($json);
	}

	public function ajax_delete_hospitais_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("hospital_model");
		$id = $this->input->post("id");
		$this->hospital_model->delete($id);

		echo json_encode($json);
	}

	public function ajax_delete_membro_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("time_model");
		$membro_id = $this->input->post("membro_id");
		$this->time_model->delete($membro_id);

		echo json_encode($json);
	}

	public function ajax_delete_user_data() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$json = array();
		$json["status"] = 1;

		$this->load->model("usuario_model");
		$id = $this->input->post("id");
		$this->usuario_model->delete($id);

		echo json_encode($json);
	}

	public function ajax_list_hospitais() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("hospital_model");
		$hospitais = $this->hospital_model->get_datatable();

		$data = array();
		foreach ($hospitais as $hospital) {

			$row = array();
			$row[] = $hospital->nome;

			if ($hospital->img) {
				$row[] = '<img src="'.base_url().$hospital->img.'" style="max-height: 100px; max-width: 100px;">';
			} else {
				$row[] = "";
			}

			$row[] = '<div class="descricao">'.$hospital->descricao.'</div>';

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-hospital" 
							id="'.$hospital->id.'">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-hospital" 
							id="'.$hospital->id.'">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;

		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->hospital_model->records_total(),
			"recordsFiltered" => $this->hospital_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}

	public function ajax_list_membro() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("time_model");
		$time = $this->time_model->get_datatable();

		$data = array();
		foreach ($time as $membro) {

			$row = array();
			$row[] = $membro->membro_nome;

			if ($membro->membro_foto) {
				$row[] = '<img src="'.base_url().$membro->membro_foto.'" style="max-height: 100px; max-width: 100px;">';
			} else {
				$row[] = "";
			}

			$row[] = '<div class="description">'.$membro->membro_descricao.'</div>';

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-membro" 
							membro_id="'.$membro->membro_id.'">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-membro" 
							membro_id="'.$membro->membro_id.'">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;

		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->time_model->records_total(),
			"recordsFiltered" => $this->time_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}

	public function ajax_list_usuario() {

		if (!$this->input->is_ajax_request()) {
			exit("Nenhum acesso de script direto permitido!");
		}

		$this->load->model("usuario_model");
		$users = $this->usuario_model->get_datatable();

		$data = array();
		foreach ($users as $user) {

			$row = array();
			$row[] = $user->email;
			$row[] = $user->username;
			$row[] = $user->email;

			$row[] = '<div style="display: inline-block;">
						<button class="btn btn-primary btn-edit-user" 
							id="'.$user->id.'">
							<i class="fa fa-edit"></i>
						</button>
						<button class="btn btn-danger btn-del-user" 
							id="'.$user->id.'">
							<i class="fa fa-times"></i>
						</button>
					</div>';

			$data[] = $row;

		}

		$json = array(
			"draw" => $this->input->post("draw"),
			"recordsTotal" => $this->usuario_model->records_total(),
			"recordsFiltered" => $this->usuario_model->records_filtered(),
			"data" => $data,
		);

		echo json_encode($json);
	}
}