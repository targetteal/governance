<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Roles Controller
 *
 * @property \App\Model\Table\RolesTable $Roles
 */
class RolesController extends AppController
{

    private function treeze(&$a, $parent_key, $children_key ) {
        $orphans = true; $i;
        while($orphans) {
            $orphans = false;
            foreach($a as $k => $v) {
                // is there $a[$k] sons?
                $sons = false;
                foreach($a as $x => $y) {
                    if (isset($y[$parent_key]) and $y[$parent_key] != false and $y[$parent_key] == $k) { 
                        $sons = true; 
                        $orphans = true; 
                        break;
                    }
                }
                // $a[$k] is a son, without children, so i can move it
                if(!$sons and isset($v[$parent_key]) and $v[$parent_key] != false) {
                    $a[$v[$parent_key]][$children_key][$k] = $v;
                    unset($a[$k]);
                }
            }
        }
    }

    public function tree() {
        $allRoles = $this->Roles->find('all', [
            'conditions' => ['Roles.organization_id' => $this->Auth->user('organization_id')], 
            'orderBy' => 'Roles.parent_id'
        ]);
        $tree = [];
        $rolesById = [];
        foreach ($allRoles as $role) {
            $rolesById[$role['id']] = [
                'name' => $role['name'],
                'parent_id' => $role['parent_id']
            ];
            if ($rolesById[$role['id']]['parent_id'] == null) {
                unset($rolesById[$role['id']]['parent_id']);
            }
        }
        
        $this->treeze($rolesById, 'parent_id', 'children');
        $this->set('tree', $rolesById);
    }

    public function nested() {
        $this->tree();
    }

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'conditions' => ['Roles.organization_id' => $this->Auth->user('organization_id')],
            'contain' => ['Organizations', 'Parent', 'SubRoles']
        ];
        $roles = $this->paginate($this->Roles);

        $this->set(compact('roles'));
        $this->set('_serialize', ['roles']);
    }

    /**
     * View method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => ['Organizations', 'Parent', 'SubRoles']
        ]);
        $this->set('role', $role);
        $this->set('_serialize', ['role']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $role = $this->Roles->newEntity();
        if ($this->request->is('post')) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            $role->organization_id = $this->Auth->user('organization_id');

            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $organizations = $this->Roles->Organizations->find('list');
        $roles = $this->getParentRolesList();
        $this->set(compact('role', 'organizations', 'roles'));
        $this->set('_serialize', ['role']);
    }

    private function getParentRolesList() {
        return $this->Roles->find('list', [
            'conditions' => [
                'organization_id' => $this->Auth->user('organization_id'),
                'is_circle' => true
            ]
        ]);
    }

    /**
     * Edit method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $role = $this->Roles->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $role = $this->Roles->patchEntity($role, $this->request->data);
            if ($this->Roles->save($role)) {
                $this->Flash->success(__('The role has been saved.'));

                return $this->redirect(['action' => 'index']);
            } else {
                $this->Flash->error(__('The role could not be saved. Please, try again.'));
            }
        }
        $organizations = $this->getParentRolesList();
        $roles = $this->Roles->find('list');
        $this->set(compact('role', 'organizations', 'roles'));
        $this->set('_serialize', ['role']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Role id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $role = $this->Roles->get($id);
        if ($this->Roles->delete($role)) {
            $this->Flash->success(__('The role has been deleted.'));
        } else {
            $this->Flash->error(__('The role could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
