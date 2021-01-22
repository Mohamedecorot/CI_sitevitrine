<?php

class Produits_model extends CI_Model
{
	private $table = 'listeproduits';

    public function ajouter_produits($nom, $description, $categorie, $illustration, $prix)
    {
        return $this->db->set(array(
                                'nom' => $nom,
                                'description' => $description,
                                'categorie' => $categorie,
                                'illustration' => $illustration,
                                'prix' => $prix
                                ))
                        ->insert($this->table);
    }


    public function get_produits()
    {
        return $this->db->select('`id`, `nom`, `description`, `categorie`, `illustration`, `prix`', false)
                ->from($this->table)
                ->order_by('id', 'desc')
                ->get()
                ->result();
    }

    public function editer_produits($id, $nom = null, $description = null, $categorie = null, $illustration = null, $prix = null)
    {
        //	Il n'y a rien à éditer
        if($nom == null AND $description == null AND $categorie == null AND $illustration == null AND $prix == null)
        {
            return false;
        }

        //	Ces données seront échappées
        if($nom != null)
        {
            $this->db->set('titre', $nom);
        }
        if($description != null)
        {
            $this->db->set('contenu', $description);
        }
        if($categorie != null)
        {
            $this->db->set('contenu', $categorie);
        }
        if($illustration != null)
        {
            $this->db->set('contenu', $illustration);
        }
        if($prix != null)
        {
            $this->db->set('contenu', $prix);
        }

        //	La condition
        $this->db->where('id', (int) $id);

        return $this->db->update($this->table);
    }

    public function supprimer_produits($id)
    {
        return $this->db->where('id', (int) $id)
                ->delete($this->table);
    }

    public function count()
    {
        return $this->db->count_all($this->table);
    }
}