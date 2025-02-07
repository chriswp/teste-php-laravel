<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Prettus\Repository\Contracts\RepositoryInterface;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


abstract class PainelController extends Controller
{
    protected $paginate = false;

    public function index()
    {
        $results = $this->repository()->with($this->relations())->scopeQuery(function ($query) {
            return $query->orderBy('id');
        });

        if($this->paginate){
            $results = $results->paginate();
        }

        if(!$this->paginate){
            $results = $results->all();
        }

        return view($this->viewIndex(), compact('results'))->with($this->variablesIndex());
    }

    protected abstract function repository(): RepositoryInterface;

    protected function relations()
    {
        return [];
    }

    protected abstract function viewIndex(): string;

    protected abstract function variablesIndex(): array;

    public function store(Request $request)
    {
        try {
            $this->validator()->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            flash('registro cadastrado com sucesso')->success();
            $this->repository()->create($request->all());

            return redirect()->back();
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    protected abstract function validator(): ValidatorInterface;

    public function create()
    {
        return view($this->viewCreate())->with($this->variablesCreate());
    }

    protected abstract function viewCreate(): string;

    protected abstract function variablesCreate(): array;

    public function show($id)
    {
        $result = $this->repository()->with($this->relations())->find($id);
        if(request()->isXmlHttpRequest()){
            return response()->json($result);
        }

        return view($this->viewShow(), compact('result'))->with($this->variablesShow());
    }

    protected abstract function viewShow(): string;

    protected abstract function variablesShow(): array;

    public function edit($id)
    {
        $result = $this->repository()->with($this->relations())->find($id);
        return view($this->viewEdit(), compact('result'))->with($this->variablesEdit());
    }

    protected abstract function viewEdit(): string;

    protected abstract function variablesEdit(): array;

    public function update(Request $request, $id)
    {
        try {
            $this->validator()->setId($id)->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            flash('registro alterado com sucesso')->success();
            $this->repository()->update($request->all(), $id);

            return redirect()->back()->with('message', 'arquivo alterado');
        } catch (ValidatorException $e) {
            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    public function destroy($id)
    {
        flash('registro removido com sucesso')->success();
        $this->repository()->delete($id);
        return redirect()->back();
    }

    protected function getValidFields(string $method, Request $request)
    {
        $rules = array_keys($this->validator()->getRules($method));
        return $request->only($rules);
    }


}
