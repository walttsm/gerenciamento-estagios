<?php

namespace App\Http\Livewire;

use App\Models\Aluno;
use App\Models\Orientador;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use PowerComponents\LivewirePowerGrid\Rules\{Rule, RuleActions};
use PowerComponents\LivewirePowerGrid\Traits\ActionButton;
use PowerComponents\LivewirePowerGrid\{Button, Column, Exportable, Footer, Header, PowerGrid, PowerGridComponent, PowerGridEloquent};

final class AlunoTable extends PowerGridComponent
{
    use ActionButton;

    /*
    |--------------------------------------------------------------------------
    |  Features Setup
    |--------------------------------------------------------------------------
    | Setup Table's general features
    |
    */
    public function setUp(): array
    {
        // $this->showCheckBox();

        return [
            // Exportable::make('export')
            //     ->striped()
            //     ->type(Exportable::TYPE_XLS, Exportable::TYPE_CSV),
            // Header::make()->showSearchInput(),
            Footer::make()
                ->showPerPage()
                ->showRecordCount(),
        ];
    }

    /*
    |--------------------------------------------------------------------------
    |  Datasource
    |--------------------------------------------------------------------------
    | Provides data to your Table using a Model or Collection
    |
    */

    /**
    * PowerGrid datasource.
    *
    * @return Builder<\App\Models\Aluno>
    */
    public function datasource(): Builder
    {
        $id_user = Auth::user()->id;
        $orientador = Orientador::where('user_id', $id_user)->first();
        return Aluno::query()->where('orientador_id', $orientador->id);
    }

    /*
    |--------------------------------------------------------------------------
    |  Relationship Search
    |--------------------------------------------------------------------------
    | Configure here relationships to be used by the Search and Table Filters.
    |
    */

    /**
     * Relationship search.
     *
     * @return array<string, array<int, string>>
     */
    public function relationSearch(): array
    {
        return [];
    }

    /*
    |--------------------------------------------------------------------------
    |  Add Column
    |--------------------------------------------------------------------------
    | Make Datasource fields available to be used as columns.
    | You can pass a closure to transform/modify the data.
    |
    | ❗ IMPORTANT: When using closures, you must escape any value coming from
    |    the database using the `e()` Laravel Helper function.
    |
    */
    public function addColumns(): PowerGridEloquent
    {
        return PowerGrid::eloquent()
            ->addColumn('nome_aluno')

           /** Example of custom column using a closure **/
            ->addColumn('nome_aluno_lower', function (Aluno $model) {
                return strtolower(e($model->nome_aluno));
            })

            ->addColumn('curso')
            ->addColumn('matricula')
            ->addColumn('email')
            ->addColumn('nome_trabalho');
    }

    /*
    |--------------------------------------------------------------------------
    |  Include Columns
    |--------------------------------------------------------------------------
    | Include the columns added columns, making them visible on the Table.
    | Each column can be configured with properties, filters, actions...
    |
    */

     /**
     * PowerGrid Columns.
     *
     * @return array<int, Column>
     */
    public function columns(): array
    {
        return [
            Column::make('NOME ALUNO', 'nome_aluno'),

            Column::make('CURSO', 'curso'),

            Column::make('MATRICULA', 'matricula'),

            Column::make('EMAIL', 'email'),

            Column::make('NOME TRABALHO', 'nome_trabalho'),

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Actions Method
    |--------------------------------------------------------------------------
    | Enable the method below only if the Routes below are defined in your app.
    |
    */

     /**
     * PowerGrid Aluno Action Buttons.
     *
     * @return array<int, Button>
     */

   
    public function actions(): array
    {
       return [
            Button::make('verAluno', '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-address-book" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                        <path d="M20 6v12a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2z"></path>
                                        <path d="M10 16h6"></path>
                                        <circle cx="13" cy="11" r="2"></circle>
                                        <path d="M4 8h3"></path>
                                        <path d="M4 12h3"></path>
                                        <path d="M4 16h3"></path>
                                    </svg>')
                ->class('inline-block px-6 py-2.5 
                bg-orange-600 text-white font-medium text-xs leading-tight 
                uppercase rounded shadow-md hover:bg-orange-700 hover:shadow-lg 
                focus:bg-orangee-700 focus:shadow-lg 
                focus:outline-none focus:ring-0 active:bg-orange-800 active:shadow-lg 
                transition duration-150 ease-in-out')
                ->route('orientador.rpodPages', ['id' => 'id']),

        //    Button::make('destroy', 'Delete')
        //        ->class('bg-red-500 cursor-pointer text-white px-3 py-2 m-1 rounded text-sm')
        //        ->route('aluno.destroy', ['aluno' => 'id'])
        //        ->method('delete')
        ];
    }
    

    /*
    |--------------------------------------------------------------------------
    | Actions Rules
    |--------------------------------------------------------------------------
    | Enable the method below to configure Rules for your Table and Action Buttons.
    |
    */

     /**
     * PowerGrid Aluno Action Rules.
     *
     * @return array<int, RuleActions>
     */

    /*
    public function actionRules(): array
    {
       return [

           //Hide button edit for ID 1
            Rule::button('edit')
                ->when(fn($aluno) => $aluno->id === 1)
                ->hide(),
        ];
    }
    */
}
