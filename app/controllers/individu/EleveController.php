<?php

namespace app\controllers\individu;

use app\models\individu\EleveModel;
use app\models\individu\ParentModel;
use app\models\individu\GenreModel;
use Flight;

class EleveController
{

    public function index()
    {
        $eleveModel = new EleveModel();
        $eleves = $eleveModel->getWithParents();

        Flight::render('eleves/index', [
            'eleves' => $eleves
        ]);
    }

    public function show($id_eleve)
    {
        $eleveModel = new EleveModel();
        $eleve = $eleveModel->getByIdWithParents($id_eleve);

        if (!$eleve) {
            Flight::notFound();
            return;
        }

        $parents = $eleveModel->getParentsByEleveId($id_eleve);

        Flight::render('eleves/show', [
            'eleve' => $eleve,
            'parents' => $parents
        ]);
    }

    public function create()
    {
        $genreModel = new GenreModel();
        $parentModel = new ParentModel();

        $genres = $genreModel->getAll();
        $parents = $parentModel->getAll();

        Flight::render('eleves/create', [
            'genres' => $genres,
            'parents' => $parents
        ]);
    }

    public function store()
    {
        $data = Flight::request()->data;

        $eleveModel = new EleveModel();
        $parentModel = new ParentModel();

        // Validation des données requises pour l'élève
        if (empty($data->nom) || empty($data->prenom) || empty($data->date_naissance)) {
            Flight::render('eleves/create', [
                'error' => 'Les champs nom, prénom et date de naissance sont obligatoires',
                'genres' => (new GenreModel())->getAll(),
                'parents' => (new ParentModel())->getAll()
            ]);
            return;
        }

        // Insertion de l'élève
        $result = $eleveModel->insert(
            $data->nom,
            $data->prenom,
            $data->date_naissance,
            $data->adresse ?? null,
            $data->contact ?? null,
            date('Y-m-d H:i:s'),
            $data->id_genre
        );

        if ($result === "Insertion réussie !") {
            $db = Flight::db();
            $id_eleve = $db->lastInsertId();

            // Gestion de l'association avec un parent
            if (isset($data->parent_option)) {
                switch ($data->parent_option) {
                    case 'existing':
                        if (!empty($data->existing_parent)) {
                            $eleveModel->associateParent($id_eleve, $data->existing_parent);
                        }
                        break;

                    case 'new':
                        if (!empty($data->new_parent_nom) && !empty($data->new_parent_prenom)) {
                            $id_parent = $parentModel->insert(
                                $data->new_parent_nom,
                                $data->new_parent_prenom,
                                $data->new_parent_contact ?? null,
                                $data->new_parent_adresse ?? null
                            );

                            if ($id_parent) {
                                $eleveModel->associateParent($id_eleve, $id_parent);
                            } else {
                                // Supprimer l'élève si l'insertion du parent échoue
                                $eleveModel->delete($id_eleve);
                                Flight::render('eleves/create', [
                                    'error' => 'Erreur lors de la création du parent',
                                    'genres' => (new GenreModel())->getAll(),
                                    'parents' => (new ParentModel())->getAll()
                                ]);
                                return;
                            }
                        }
                        break;

                }
            }

            Flight::redirect('/eleves');
        } else {
            Flight::render('eleves/create', [
                'error' => $result,
                'genres' => (new GenreModel())->getAll(),
                'parents' => (new ParentModel())->getAll()
            ]);
        }
    }
}