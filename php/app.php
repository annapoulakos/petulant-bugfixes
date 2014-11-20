<?php

// includes
$model = Application::GetModel();
$view = Application::GetView();

$params = Application::ProcessRequest($model);

$view->Render($params);

class Application {
    public static function GetModel () {
        if (is_null(self::$route)) {
            self::GenerateRoute();
        }

        $model = self::$route->model;

        return \Idiorm\Model::Factory($model);
    }

    public static function GetView () {
        if (is_null(self::$route)) {
            self::GenerateRoute();
        }

        $view = self::$route->view;

        return new $view();
    }

    public static function ProcessRequest ($model) {
        if (is_null(self::$route)) {
            self::GenerateRoute();
        }

        $method = self::$route->method;

        self::$method($model);
    }

    public static function get ($model) {
        if (is_null(self::$route->id)) {
            return $model->find_many();
        }

        return $model->find_one(self::$route->id);
    }
    public static function post ($model) {
        $new = $model->create();

        $data = json_decode(file_get_contents('php://input'));
        foreach ($data as $field => $value) {
            $new->$field = $value;
        }
        $new->save();

        return $new;
    }
    public static function put ($model) {

    }
    public static function delete ($model) {

    }

    public static function GenerateRoute () {
        // TODO: This needs to validate incoming model requests.
        //      Failed or invalid attempts need to render a different view (and have the model be null);
    }
}
