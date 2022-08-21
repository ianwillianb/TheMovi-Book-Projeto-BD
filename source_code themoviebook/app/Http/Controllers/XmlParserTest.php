<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use XmlParser;

class XmlParserTest extends Controller
{
    public function parse()
    {
        $xml = XmlParser::load('http://dainf.ct.utfpr.edu.br/~gomesjr/BD1/data/person.xml');
        $users = $xml->parse([
            'name' => ['uses' => 'Person[::name>name]'],
        ]);
        foreach($users['name'] as $user) {
            echo $user['name'];
        }
        return view('teste');
    }
}
