<?php
namespace App\Controller;
use App\Controller\AppController;

class GymProductController extends AppController
{
	public function productList()
	{
		$session = $this->request->session()->read("User");
		$role = $session["role_name"];
		$data = $this->GymProduct->find("all")->hydrate(false)->toArray();
		$this->set("data",$data);
		$this->set("role",$role);
	}

	public function addProduct()
	{
		$session = $this->request->session()->read("User");
		$this->set("edit",false);
		if($this->request->is("post"))
		{
			$image = $this->GYMFunction->uploadImage($this->request->data['product_image']);
			$row = $this->GymProduct->newEntity();
			$this->request->data["created_by"] = $session["id"];
			$this->request->data["created_date"] = date("Y-m-d");
			$this->request->data['product_image'] = (!empty($image)) ? $image : "Thumbnail-img.png";

			$row = $this->GymProduct->patchEntity($row,$this->request->data);
			if($this->GymProduct->save($row))
			{
				$this->Flash->success(__("Sucesso! Registro salvo com sucesso."));
				return $this->redirect(["action"=>"productList"]);
			}else{
				$this->Flash->error(__("Erro! Registro não salvo. Tente novamente."));
			}
		}		
	}
	
	public function editProduct($pid)
	{	
		$this->set("edit",true);		
		$row = $this->GymProduct->get($pid);
		$this->set("data",$row->toArray());
		
		if($this->request->is("post"))
		{
			$image = $this->GYMFunction->uploadImage($this->request->data['product_image']);
			
            if (!empty($image)) {
                $this->request->data['product_image'] = $image;
            }

			$row = $this->GymProduct->patchEntity($row,$this->request->data);
			if($this->GymProduct->save($row))
			{
				$this->Flash->success(__("Sucesso! Registro atualizado com sucesso."));
				return $this->redirect(["action"=>"productList"]);
			}else{
				$this->Flash->error(__("Erro! Registro não atualizado. Tente novamente. "));
			}
		}
		$this->render("addProduct");
	}
	
	public function deleteProduct($did)
	{
		$this->autoRander = false;
		$row = $this->GymProduct->get($did);
		if($this->GymProduct->delete($row))
		{
			$this->Flash->success(__("Sucesso! Registro excluído com sucesso."));
			return $this->redirect($this->referer());
		} else{ echo false;}		
	}
	
	public function isAuthorized($user)
	{
		$role_name = $user["role_name"];
		$curr_action = $this->request->action;
		$members_actions = ["productList"];
		$staff__acc_actions = ["productList","addProduct","editProduct"];
		switch($role_name)
		{			
			CASE "member":
				if(in_array($curr_action,$members_actions))
				{return true;}else{return false;}
			break;
			
			/*CASE "staff_member":
				if(in_array($curr_action,$staff__acc_actions))
				{return true;}else{ return false;}
			break;*/
			
			CASE "accountant":
				if(in_array($curr_action,$staff__acc_actions))
				{return true;}else{return false;}
			break;
		}		
		return parent::isAuthorized($user);
	}
}