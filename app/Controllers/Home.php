<?php

namespace App\Controllers;
use App\Models\ProductModel;

class Home extends BaseController
{
    public function index(): string
    {
        return view('welcome_message');
    }
    public function homepage()
    {
        return view('homepage');
    }
    public function hp($id = null)
    {
        $data['id'] = $id;
        return view('homepage', $data);
    }
    public function table_products()
    {
        $p = new ProductModel();
        $data['pr'] = $p->findAll();
        return view('products', $data);
    }
    public function showInsertForm()
    {
        // Load your insert form view
        return view('insert');
    }

    // Handle product insertion
    public function insertProduct() 
    {
        // Logic to insert the product into the database goes here

        // After inserting, redirect to the homepage or display a success message
        return redirect()->to('/table_products');
    }
    public function insert()
    {
        if ($this->request->getMethod() === 'post') {
            // Get form input values
            $name = $this->request->getPost('Name');
            $description = $this->request->getPost('Description');
            $category = $this->request->getPost('Category');
            $price = $this->request->getPost('Price');
            $quantity = $this->request->getPost('Quantity');

            // Check if any required field is empty
            if (empty($name) || empty($description) || empty($category) || empty($price) || empty($quantity)) {
                // Set a flash message for error
                session()->setFlashdata('error', 'All fields are required.');

                return redirect()->to('/insert'); // Redirect back to the insert form
            }

            // Data is valid, proceed to insert into the database
            $data = [
                'Name' => $name,
                'Description' => $description,
                'Category' => $category,
                'Price' => $price,
                'Quantity' => $quantity
            ];

            // Assuming you have a model named ProductModel
            $model = new ProductModel();
            $model->insert($data);

            // Set a flash message for success
            session()->setFlashdata('msg', 'Product Added Auccessfully.');

            return redirect()->to('/table_products');
        }
    }
    
    public function edit($id=null)
    {
        $p = new ProductModel();
        $data['p'] = $p->where('id', $id)->first();
        return view('edit', $data);
    }
    public function update()
    {
        $id = $this->request->getVar('id');
        $name = $this->request->getVar('Name');
        $desc = $this->request->getVar('Description');
        $categ = $this->request->getVar('Category');  // Fixed variable name
        $quant = $this->request->getVar('Quantity');
        $price = $this->request->getVar('Price');
        
        $p = new ProductModel();
        $data = [
            'id' => $id,
            'Name' => $name,
            'Description' => $desc,
            'Category' => $categ,  // Fixed variable name
            'Quantity' => $quant,
            'Price' => $price
        ];
        $p->set($data)->where('id', $id)->update();
        $session = session();
        $session->setFlashdata('msg', 'Update Successful');
        return redirect()->to('/table_products');
    }
    

public function delete($id = null)
{
    if ($id === null) {
        // Handle when no id is provided
        return redirect()->to('/table_products');  // Redirect to the product table_products
    }

    $p = new ProductModel();

    // Check if the product exists
    $product = $p->where('id', $id)->first();
    if ($product) {
        // Product exists, delete it from the database
        $p->where('id', $id)->delete();

        $session = session();
        $session->setFlashdata('msg', 'Product Deleted Successfully');
    } else {
        $session = session();
        $session->setFlashdata('msg', 'Product not found for deletion');
    }

    return redirect()->to('/table_products');  // Redirect to the homepage
}
}
