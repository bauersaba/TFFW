<?php
/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 *                                   ATTENTION!
 * If you see this message in your browser (Internet Explorer, Mozilla Firefox, Google Chrome, etc.)
 * this means that PHP is not properly installed on your web server. Please refer to the PHP manual
 * for more details: http://php.net/manual/install.php 
 *
 * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 */

    include_once dirname(__FILE__) . '/components/startup.php';
    include_once dirname(__FILE__) . '/components/application.php';
    include_once dirname(__FILE__) . '/' . 'authorization.php';


    include_once dirname(__FILE__) . '/' . 'database_engine/mysql_engine.php';
    include_once dirname(__FILE__) . '/' . 'components/page/page_includes.php';

    function GetConnectionOptions()
    {
        $result = GetGlobalConnectionOptions();
        $result['client_encoding'] = 'utf8';
        GetApplication()->GetUserAuthentication()->applyIdentityToConnectionOptions($result);
        return $result;
    }

    
    
    
    
    // OnBeforePageExecute event handler
    
    
    
    class produto_pedidoPage extends DetailPage
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Pedido');
            $this->SetMenuLabel('Pedido');
    
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`pedido`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new IntegerField('valorPedido'),
                    new IntegerField('quantidadeProduto'),
                    new IntegerField('fk_produto'),
                    new IntegerField('fk_usuario')
                )
            );
            $this->dataset->AddLookupField('fk_produto', 'produto', new IntegerField('id'), new StringField('nomeProduto', false, false, false, false, 'fk_produto_nomeProduto', 'fk_produto_nomeProduto_produto'), 'fk_produto_nomeProduto_produto');
            $this->dataset->AddLookupField('fk_usuario', 'usuario', new IntegerField('id'), new StringField('usuario', false, false, false, false, 'fk_usuario_usuario', 'fk_usuario_usuario_usuario'), 'fk_usuario_usuario_usuario');
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'valorPedido', 'valorPedido', 'Valor Pedido'),
                new FilterColumn($this->dataset, 'quantidadeProduto', 'quantidadeProduto', 'Quantidade Produto'),
                new FilterColumn($this->dataset, 'fk_produto', 'fk_produto_nomeProduto', 'Fk Produto'),
                new FilterColumn($this->dataset, 'fk_usuario', 'fk_usuario_usuario', 'Fk Usuario')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['valorPedido'])
                ->addColumn($columns['quantidadeProduto'])
                ->addColumn($columns['fk_produto'])
                ->addColumn($columns['fk_usuario']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
            $columnFilter
                ->setOptionsFor('fk_produto')
                ->setOptionsFor('fk_usuario');
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('valorpedido_edit');
            
            $filterBuilder->addColumn(
                $columns['valorPedido'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('quantidadeproduto_edit');
            
            $filterBuilder->addColumn(
                $columns['quantidadeProduto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('fk_produto_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_produto_pedido_fk_produto_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('fk_produto', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_produto_pedido_fk_produto_search');
            
            $text_editor = new TextEdit('fk_produto');
            
            $filterBuilder->addColumn(
                $columns['fk_produto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new DynamicCombobox('fk_usuario_edit', $this->CreateLinkBuilder());
            $main_editor->setAllowClear(true);
            $main_editor->setMinimumInputLength(0);
            $main_editor->SetAllowNullValue(false);
            $main_editor->SetHandlerName('filter_builder_produto_pedido_fk_usuario_search');
            
            $multi_value_select_editor = new RemoteMultiValueSelect('fk_usuario', $this->CreateLinkBuilder());
            $multi_value_select_editor->SetHandlerName('filter_builder_produto_pedido_fk_usuario_search');
            
            $text_editor = new TextEdit('fk_usuario');
            
            $filterBuilder->addColumn(
                $columns['fk_usuario'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $text_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $text_editor,
                    FilterConditionOperator::BEGINS_WITH => $text_editor,
                    FilterConditionOperator::ENDS_WITH => $text_editor,
                    FilterConditionOperator::IS_LIKE => $text_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $text_editor,
                    FilterConditionOperator::IN => $multi_value_select_editor,
                    FilterConditionOperator::NOT_IN => $multi_value_select_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for valorPedido field
            //
            $column = new NumberViewColumn('valorPedido', 'valorPedido', 'Valor Pedido', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for quantidadeProduto field
            //
            $column = new NumberViewColumn('quantidadeProduto', 'quantidadeProduto', 'Quantidade Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('fk_produto', 'fk_produto_nomeProduto', 'Fk Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for usuario field
            //
            $column = new TextViewColumn('fk_usuario', 'fk_usuario_usuario', 'Fk Usuario', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for valorPedido field
            //
            $column = new NumberViewColumn('valorPedido', 'valorPedido', 'Valor Pedido', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for quantidadeProduto field
            //
            $column = new NumberViewColumn('quantidadeProduto', 'quantidadeProduto', 'Quantidade Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('fk_produto', 'fk_produto_nomeProduto', 'Fk Produto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for usuario field
            //
            $column = new TextViewColumn('fk_usuario', 'fk_usuario_usuario', 'Fk Usuario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for valorPedido field
            //
            $editor = new TextEdit('valorpedido_edit');
            $editColumn = new CustomEditColumn('Valor Pedido', 'valorPedido', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for quantidadeProduto field
            //
            $editor = new TextEdit('quantidadeproduto_edit');
            $editColumn = new CustomEditColumn('Quantidade Produto', 'quantidadeProduto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fk_produto field
            //
            $editor = new DynamicCombobox('fk_produto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fk Produto', 'fk_produto', 'fk_produto_nomeProduto', 'edit_produto_pedido_fk_produto_search', $editor, $this->dataset, $lookupDataset, 'id', 'nomeProduto', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for fk_usuario field
            //
            $editor = new DynamicCombobox('fk_usuario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fk Usuario', 'fk_usuario', 'fk_usuario_usuario', 'edit_produto_pedido_fk_usuario_search', $editor, $this->dataset, $lookupDataset, 'id', 'usuario', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for valorPedido field
            //
            $editor = new TextEdit('valorpedido_edit');
            $editColumn = new CustomEditColumn('Valor Pedido', 'valorPedido', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for quantidadeProduto field
            //
            $editor = new TextEdit('quantidadeproduto_edit');
            $editColumn = new CustomEditColumn('Quantidade Produto', 'quantidadeProduto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fk_produto field
            //
            $editor = new DynamicCombobox('fk_produto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fk Produto', 'fk_produto', 'fk_produto_nomeProduto', 'multi_edit_produto_pedido_fk_produto_search', $editor, $this->dataset, $lookupDataset, 'id', 'nomeProduto', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for fk_usuario field
            //
            $editor = new DynamicCombobox('fk_usuario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fk Usuario', 'fk_usuario', 'fk_usuario_usuario', 'multi_edit_produto_pedido_fk_usuario_search', $editor, $this->dataset, $lookupDataset, 'id', 'usuario', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for valorPedido field
            //
            $editor = new TextEdit('valorpedido_edit');
            $editColumn = new CustomEditColumn('Valor Pedido', 'valorPedido', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for quantidadeProduto field
            //
            $editor = new TextEdit('quantidadeproduto_edit');
            $editColumn = new CustomEditColumn('Quantidade Produto', 'quantidadeProduto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fk_produto field
            //
            $editor = new DynamicCombobox('fk_produto_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fk Produto', 'fk_produto', 'fk_produto_nomeProduto', 'insert_produto_pedido_fk_produto_search', $editor, $this->dataset, $lookupDataset, 'id', 'nomeProduto', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for fk_usuario field
            //
            $editor = new DynamicCombobox('fk_usuario_edit', $this->CreateLinkBuilder());
            $editor->setAllowClear(true);
            $editor->setMinimumInputLength(0);
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $editColumn = new DynamicLookupEditColumn('Fk Usuario', 'fk_usuario', 'fk_usuario_usuario', 'insert_produto_pedido_fk_usuario_search', $editor, $this->dataset, $lookupDataset, 'id', 'usuario', '');
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for valorPedido field
            //
            $column = new NumberViewColumn('valorPedido', 'valorPedido', 'Valor Pedido', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddPrintColumn($column);
            
            //
            // View column for quantidadeProduto field
            //
            $column = new NumberViewColumn('quantidadeProduto', 'quantidadeProduto', 'Quantidade Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('fk_produto', 'fk_produto_nomeProduto', 'Fk Produto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for usuario field
            //
            $column = new TextViewColumn('fk_usuario', 'fk_usuario_usuario', 'Fk Usuario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for valorPedido field
            //
            $column = new NumberViewColumn('valorPedido', 'valorPedido', 'Valor Pedido', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddExportColumn($column);
            
            //
            // View column for quantidadeProduto field
            //
            $column = new NumberViewColumn('quantidadeProduto', 'quantidadeProduto', 'Quantidade Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('fk_produto', 'fk_produto_nomeProduto', 'Fk Produto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for usuario field
            //
            $column = new TextViewColumn('fk_usuario', 'fk_usuario_usuario', 'Fk Usuario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for valorPedido field
            //
            $column = new NumberViewColumn('valorPedido', 'valorPedido', 'Valor Pedido', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(4);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('.');
            $grid->AddCompareColumn($column);
            
            //
            // View column for quantidadeProduto field
            //
            $column = new NumberViewColumn('quantidadeProduto', 'quantidadeProduto', 'Quantidade Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('fk_produto', 'fk_produto_nomeProduto', 'Fk Produto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for usuario field
            //
            $column = new TextViewColumn('fk_usuario', 'fk_usuario_usuario', 'Fk Usuario', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_produto_pedido_fk_produto_search', 'id', 'nomeProduto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'insert_produto_pedido_fk_usuario_search', 'id', 'usuario', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_produto_pedido_fk_produto_search', 'id', 'nomeProduto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'filter_builder_produto_pedido_fk_usuario_search', 'id', 'usuario', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_produto_pedido_fk_produto_search', 'id', 'nomeProduto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'edit_produto_pedido_fk_usuario_search', 'id', 'usuario', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
            $lookupDataset->setOrderByField('nomeProduto', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_produto_pedido_fk_produto_search', 'id', 'nomeProduto', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
            
            $lookupDataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`usuario`');
            $lookupDataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('usuario'),
                    new StringField('senha')
                )
            );
            $lookupDataset->setOrderByField('usuario', 'ASC');
            $handler = new DynamicSearchHandler($lookupDataset, $this, 'multi_edit_produto_pedido_fk_usuario_search', 'id', 'usuario', null, 20);
            GetApplication()->RegisterHTTPHandler($handler);
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }
    
    // OnBeforePageExecute event handler
    
    
    
    class produtoPage extends Page
    {
        protected function DoBeforeCreate()
        {
            $this->SetTitle('Produto');
            $this->SetMenuLabel('Produto');
    
            $this->dataset = new TableDataset(
                MyPDOConnectionFactory::getInstance(),
                GetConnectionOptions(),
                '`produto`');
            $this->dataset->addFields(
                array(
                    new IntegerField('id', true, true, true),
                    new StringField('nomeProduto'),
                    new IntegerField('qtd'),
                    new IntegerField('valorUnitario'),
                    new StringField('imagem'),
                    new StringField('thumb')
                )
            );
        }
    
        protected function DoPrepare() {
    
        }
    
        protected function CreatePageNavigator()
        {
            $result = new CompositePageNavigator($this);
            
            $partitionNavigator = new PageNavigator('pnav', $this, $this->dataset);
            $partitionNavigator->SetRowsPerPage(20);
            $result->AddPageNavigator($partitionNavigator);
            
            return $result;
        }
    
        protected function CreateRssGenerator()
        {
            return null;
        }
    
        protected function setupCharts()
        {
    
        }
    
        protected function getFiltersColumns()
        {
            return array(
                new FilterColumn($this->dataset, 'id', 'id', 'Id'),
                new FilterColumn($this->dataset, 'nomeProduto', 'nomeProduto', 'Nome Produto'),
                new FilterColumn($this->dataset, 'qtd', 'qtd', 'Qtd'),
                new FilterColumn($this->dataset, 'valorUnitario', 'valorUnitario', 'Valor Unitario'),
                new FilterColumn($this->dataset, 'imagem', 'imagem', 'Imagem'),
                new FilterColumn($this->dataset, 'thumb', 'thumb', 'Foto')
            );
        }
    
        protected function setupQuickFilter(QuickFilter $quickFilter, FixedKeysArray $columns)
        {
            $quickFilter
                ->addColumn($columns['id'])
                ->addColumn($columns['nomeProduto'])
                ->addColumn($columns['qtd'])
                ->addColumn($columns['valorUnitario'])
                ->addColumn($columns['imagem'])
                ->addColumn($columns['thumb']);
        }
    
        protected function setupColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function setupFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
            $main_editor = new TextEdit('id_edit');
            
            $filterBuilder->addColumn(
                $columns['id'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('nomeproduto_edit');
            $main_editor->SetMaxLength(50);
            
            $filterBuilder->addColumn(
                $columns['nomeProduto'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('qtd_edit');
            
            $filterBuilder->addColumn(
                $columns['qtd'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('valorunitario_edit');
            
            $filterBuilder->addColumn(
                $columns['valorUnitario'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('imagem');
            
            $filterBuilder->addColumn(
                $columns['imagem'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
            
            $main_editor = new TextEdit('thumb_edit');
            
            $filterBuilder->addColumn(
                $columns['thumb'],
                array(
                    FilterConditionOperator::EQUALS => $main_editor,
                    FilterConditionOperator::DOES_NOT_EQUAL => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN => $main_editor,
                    FilterConditionOperator::IS_GREATER_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN => $main_editor,
                    FilterConditionOperator::IS_LESS_THAN_OR_EQUAL_TO => $main_editor,
                    FilterConditionOperator::IS_BETWEEN => $main_editor,
                    FilterConditionOperator::IS_NOT_BETWEEN => $main_editor,
                    FilterConditionOperator::CONTAINS => $main_editor,
                    FilterConditionOperator::DOES_NOT_CONTAIN => $main_editor,
                    FilterConditionOperator::BEGINS_WITH => $main_editor,
                    FilterConditionOperator::ENDS_WITH => $main_editor,
                    FilterConditionOperator::IS_LIKE => $main_editor,
                    FilterConditionOperator::IS_NOT_LIKE => $main_editor,
                    FilterConditionOperator::IS_BLANK => null,
                    FilterConditionOperator::IS_NOT_BLANK => null
                )
            );
        }
    
        protected function AddOperationsColumns(Grid $grid)
        {
            $actions = $grid->getActions();
            $actions->setCaption($this->GetLocalizerCaptions()->GetMessageString('Actions'));
            $actions->setPosition(ActionList::POSITION_LEFT);
            
            if ($this->GetSecurityInfo()->HasViewGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('View'), OPERATION_VIEW, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
            
            if ($this->GetSecurityInfo()->HasEditGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Edit'), OPERATION_EDIT, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowEditButtonHandler', $this);
            }
            
            if ($this->GetSecurityInfo()->HasDeleteGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Delete'), OPERATION_DELETE, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
                $operation->OnShow->AddListener('ShowDeleteButtonHandler', $this);
                $operation->SetAdditionalAttribute('data-modal-operation', 'delete');
                $operation->SetAdditionalAttribute('data-delete-handler-name', $this->GetModalGridDeleteHandler());
            }
            
            if ($this->GetSecurityInfo()->HasAddGrant())
            {
                $operation = new LinkOperation($this->GetLocalizerCaptions()->GetMessageString('Copy'), OPERATION_COPY, $this->dataset, $grid);
                $operation->setUseImage(true);
                $actions->addOperation($operation);
            }
        }
    
        protected function AddFieldColumns(Grid $grid, $withDetails = true)
        {
            if (GetCurrentUserPermissionsForPage('produto.pedido')->HasViewGrant() && $withDetails)
            {
            //
            // View column for produto_pedido detail
            //
            $column = new DetailColumn(array('id'), 'produto.pedido', 'produto_pedido_handler', $this->dataset, 'Pedido');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $grid->AddViewColumn($column);
            }
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('nomeProduto', 'nomeProduto', 'Nome Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for qtd field
            //
            $column = new NumberViewColumn('qtd', 'qtd', 'Qtd', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for valorUnitario field
            //
            $column = new CurrencyViewColumn('valorUnitario', 'valorUnitario', 'Valor Unitario', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator(',');
            $column->setCurrencySign('R$ ');
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
            
            //
            // View column for thumb field
            //
            $column = new ExternalImageViewColumn('thumb', 'thumb', 'Foto', $this->dataset);
            $column->SetOrderable(true);
            $column->setMinimalVisibility(ColumnVisibility::PHONE);
            $column->SetDescription('');
            $column->SetFixedWidth(null);
            $grid->AddViewColumn($column);
        }
    
        protected function AddSingleRecordViewColumns(Grid $grid)
        {
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('nomeProduto', 'nomeProduto', 'Nome Produto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for qtd field
            //
            $column = new NumberViewColumn('qtd', 'qtd', 'Qtd', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for valorUnitario field
            //
            $column = new CurrencyViewColumn('valorUnitario', 'valorUnitario', 'Valor Unitario', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator(',');
            $column->setCurrencySign('R$ ');
            $grid->AddSingleRecordViewColumn($column);
            
            //
            // View column for imagem field
            //
            $column = new ExternalImageViewColumn('imagem', 'imagem', 'Imagem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddSingleRecordViewColumn($column);
        }
    
        protected function AddEditColumns(Grid $grid)
        {
            //
            // Edit column for nomeProduto field
            //
            $editor = new TextEdit('nomeproduto_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Nome Produto', 'nomeProduto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for qtd field
            //
            $editor = new TextEdit('qtd_edit');
            $editColumn = new CustomEditColumn('Qtd', 'qtd', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for valorUnitario field
            //
            $editor = new TextEdit('valorunitario_edit');
            $editColumn = new CustomEditColumn('Valor Unitario', 'valorUnitario', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
            
            //
            // Edit column for imagem field
            //
            $editor = new ImageUploader('imagem_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Imagem', 'imagem', $editor, $this->dataset, false, false, 'imagens/', '%original_file_name%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb',
                'imagens/',
                Delegate::CreateFromMethod($this, 'imagem_Thumbnail_GenerateFileName_edit'),
                new ImageFitByWidthResizeFilter(150),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddEditColumn($editColumn);
        }
    
        protected function AddMultiEditColumns(Grid $grid)
        {
            //
            // Edit column for nomeProduto field
            //
            $editor = new TextEdit('nomeproduto_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Nome Produto', 'nomeProduto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for qtd field
            //
            $editor = new TextEdit('qtd_edit');
            $editColumn = new CustomEditColumn('Qtd', 'qtd', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for valorUnitario field
            //
            $editor = new TextEdit('valorunitario_edit');
            $editColumn = new CustomEditColumn('Valor Unitario', 'valorUnitario', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for imagem field
            //
            $editor = new ImageUploader('imagem_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Imagem', 'imagem', $editor, $this->dataset, false, false, 'imagens/', '%original_file_name%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb',
                'imagens/',
                Delegate::CreateFromMethod($this, 'imagem_Thumbnail_GenerateFileName_multi_edit'),
                new ImageFitByWidthResizeFilter(150),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
            
            //
            // Edit column for thumb field
            //
            $editor = new TextEdit('thumb_edit');
            $editColumn = new CustomEditColumn('Foto', 'thumb', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddMultiEditColumn($editColumn);
        }
    
        protected function AddInsertColumns(Grid $grid)
        {
            //
            // Edit column for nomeProduto field
            //
            $editor = new TextEdit('nomeproduto_edit');
            $editor->SetMaxLength(50);
            $editColumn = new CustomEditColumn('Nome Produto', 'nomeProduto', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for qtd field
            //
            $editor = new TextEdit('qtd_edit');
            $editColumn = new CustomEditColumn('Qtd', 'qtd', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for valorUnitario field
            //
            $editor = new TextEdit('valorunitario_edit');
            $editColumn = new CustomEditColumn('Valor Unitario', 'valorUnitario', $editor, $this->dataset);
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            
            //
            // Edit column for imagem field
            //
            $editor = new ImageUploader('imagem_edit');
            $editor->SetShowImage(true);
            $editor->setAcceptableFileTypes('image/*');
            $editColumn = new UploadFileToFolderColumn('Imagem', 'imagem', $editor, $this->dataset, false, false, 'imagens/', '%original_file_name%', $this->OnFileUpload, false);
            $editColumn->SetReplaceUploadedFileIfExist(true);
            $editColumn->SetGenerationImageThumbnails(
                'thumb',
                'imagens/',
                Delegate::CreateFromMethod($this, 'imagem_Thumbnail_GenerateFileName_insert'),
                new ImageFitByWidthResizeFilter(150),
                false
            );
            $editColumn->SetAllowSetToNull(true);
            $this->ApplyCommonColumnEditProperties($editColumn);
            $grid->AddInsertColumn($editColumn);
            $grid->SetShowAddButton(true && $this->GetSecurityInfo()->HasAddGrant());
        }
    
        private function AddMultiUploadColumn(Grid $grid)
        {
    
        }
    
        protected function AddPrintColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('nomeProduto', 'nomeProduto', 'Nome Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddPrintColumn($column);
            
            //
            // View column for qtd field
            //
            $column = new NumberViewColumn('qtd', 'qtd', 'Qtd', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddPrintColumn($column);
            
            //
            // View column for valorUnitario field
            //
            $column = new CurrencyViewColumn('valorUnitario', 'valorUnitario', 'Valor Unitario', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator(',');
            $column->setCurrencySign('R$ ');
            $grid->AddPrintColumn($column);
            
            //
            // View column for imagem field
            //
            $column = new ExternalImageViewColumn('imagem', 'imagem', 'Imagem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
            
            //
            // View column for thumb field
            //
            $column = new ExternalImageViewColumn('thumb', 'thumb', 'Foto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddPrintColumn($column);
        }
    
        protected function AddExportColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('nomeProduto', 'nomeProduto', 'Nome Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddExportColumn($column);
            
            //
            // View column for qtd field
            //
            $column = new NumberViewColumn('qtd', 'qtd', 'Qtd', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddExportColumn($column);
            
            //
            // View column for valorUnitario field
            //
            $column = new CurrencyViewColumn('valorUnitario', 'valorUnitario', 'Valor Unitario', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator(',');
            $column->setCurrencySign('R$ ');
            $grid->AddExportColumn($column);
            
            //
            // View column for imagem field
            //
            $column = new ExternalImageViewColumn('imagem', 'imagem', 'Imagem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
            
            //
            // View column for thumb field
            //
            $column = new ExternalImageViewColumn('thumb', 'thumb', 'Foto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddExportColumn($column);
        }
    
        private function AddCompareColumns(Grid $grid)
        {
            //
            // View column for id field
            //
            $column = new NumberViewColumn('id', 'id', 'Id', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for nomeProduto field
            //
            $column = new TextViewColumn('nomeProduto', 'nomeProduto', 'Nome Produto', $this->dataset);
            $column->SetOrderable(true);
            $column->setAlign('left');
            $grid->AddCompareColumn($column);
            
            //
            // View column for qtd field
            //
            $column = new NumberViewColumn('qtd', 'qtd', 'Qtd', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(0);
            $column->setThousandsSeparator(',');
            $column->setDecimalSeparator('');
            $grid->AddCompareColumn($column);
            
            //
            // View column for valorUnitario field
            //
            $column = new CurrencyViewColumn('valorUnitario', 'valorUnitario', 'Valor Unitario', $this->dataset);
            $column->SetOrderable(true);
            $column->setNumberAfterDecimal(2);
            $column->setThousandsSeparator('');
            $column->setDecimalSeparator(',');
            $column->setCurrencySign('R$ ');
            $grid->AddCompareColumn($column);
            
            //
            // View column for imagem field
            //
            $column = new ExternalImageViewColumn('imagem', 'imagem', 'Imagem', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
            
            //
            // View column for thumb field
            //
            $column = new ExternalImageViewColumn('thumb', 'thumb', 'Foto', $this->dataset);
            $column->SetOrderable(true);
            $grid->AddCompareColumn($column);
        }
    
        private function AddCompareHeaderColumns(Grid $grid)
        {
    
        }
    
        public function GetPageDirection()
        {
            return null;
        }
    
        public function isFilterConditionRequired()
        {
            return false;
        }
    
        protected function ApplyCommonColumnEditProperties(CustomEditColumn $column)
        {
            $column->SetDisplaySetToNullCheckBox(false);
            $column->SetDisplaySetToDefaultCheckBox(false);
    		$column->SetVariableContainer($this->GetColumnVariableContainer());
        }
    
        function CreateMasterDetailRecordGrid()
        {
            $result = new Grid($this, $this->dataset);
            
            $this->AddFieldColumns($result, false);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            
            $result->SetAllowDeleteSelected(false);
            $result->SetShowUpdateLink(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(false);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $this->setupGridColumnGroup($result);
            $this->attachGridEventHandlers($result);
            
            return $result;
        }
        public function imagem_Thumbnail_GenerateFileName_insert(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'imagens/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVariablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        function GetCustomClientScript()
        {
            return ;
        }
        
        function GetOnPageLoadedClientScript()
        {
            return ;
        }
        public function imagem_Thumbnail_GenerateFileName_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'imagens/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVariablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        public function imagem_Thumbnail_GenerateFileName_multi_edit(&$filepath, &$handled, $original_file_name, $original_file_extension, $file_size)
        {
        $targetFolder = FormatDatasetFieldsTemplate($this->GetDataset(), 'imagens/');
        FileUtils::ForceDirectories($targetFolder);
        
        $filename = ApplyVariablesMapToTemplate('small_%original_file_name%',
            array(
                'original_file_name' => $original_file_name,
                'original_file_extension' => $original_file_extension,
                'file_size' => $file_size
            )
        );
        $filepath = Path::Combine($targetFolder, $filename);
        
        $handled = true;
        }
        
        protected function GetEnableModalGridDelete() { return true; }
    
        protected function CreateGrid()
        {
            $result = new Grid($this, $this->dataset);
            if ($this->GetSecurityInfo()->HasDeleteGrant())
               $result->SetAllowDeleteSelected(true);
            else
               $result->SetAllowDeleteSelected(false);   
            
            ApplyCommonPageSettings($this, $result);
            
            $result->SetUseImagesForActions(true);
            $result->SetUseFixedHeader(false);
            $result->SetShowLineNumbers(false);
            $result->SetShowKeyColumnsImagesInHeader(false);
            $result->SetViewMode(ViewMode::TABLE);
            $result->setEnableRuntimeCustomization(true);
            $result->setAllowCompare(true);
            $this->AddCompareHeaderColumns($result);
            $this->AddCompareColumns($result);
            $result->setMultiEditAllowed($this->GetSecurityInfo()->HasEditGrant() && true);
            $result->setTableBordered(false);
            $result->setTableCondensed(false);
            
            $result->SetHighlightRowAtHover(false);
            $result->SetWidth('');
            $this->AddOperationsColumns($result);
            $this->AddFieldColumns($result);
            $this->AddSingleRecordViewColumns($result);
            $this->AddEditColumns($result);
            $this->AddMultiEditColumns($result);
            $this->AddInsertColumns($result);
            $this->AddPrintColumns($result);
            $this->AddExportColumns($result);
            $this->AddMultiUploadColumn($result);
    
    
            $this->SetShowPageList(true);
            $this->SetShowTopPageNavigator(true);
            $this->SetShowBottomPageNavigator(true);
            $this->setPrintListAvailable(true);
            $this->setPrintListRecordAvailable(false);
            $this->setPrintOneRecordAvailable(true);
            $this->setAllowPrintSelectedRecords(true);
            $this->setExportListAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportSelectedRecordsAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
            $this->setExportListRecordAvailable(array());
            $this->setExportOneRecordAvailable(array('pdf', 'excel', 'word', 'xml', 'csv'));
    
            return $result;
        }
     
        protected function setClientSideEvents(Grid $grid) {
    
        }
    
        protected function doRegisterHandlers() {
            $detailPage = new produto_pedidoPage('produto_pedido', $this, array('fk_produto'), array('id'), $this->GetForeignKeyFields(), $this->CreateMasterDetailRecordGrid(), $this->dataset, GetCurrentUserPermissionsForPage('produto.pedido'), 'UTF-8');
            $detailPage->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource('produto.pedido'));
            $detailPage->SetHttpHandlerName('produto_pedido_handler');
            $handler = new PageHTTPHandler('produto_pedido_handler', $detailPage);
            GetApplication()->RegisterHTTPHandler($handler);
            
        }
       
        protected function doCustomRenderColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderPrintColumn($fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomRenderExportColumn($exportType, $fieldName, $fieldData, $rowData, &$customText, &$handled)
        { 
    
        }
    
        protected function doCustomDrawRow($rowData, &$cellFontColor, &$cellFontSize, &$cellBgColor, &$cellItalicAttr, &$cellBoldAttr)
        {
    
        }
    
        protected function doExtendedCustomDrawRow($rowData, &$rowCellStyles, &$rowStyles, &$rowClasses, &$cellClasses)
        {
    
        }
    
        protected function doCustomRenderTotal($totalValue, $aggregate, $columnName, &$customText, &$handled)
        {
    
        }
    
        protected function doCustomDefaultValues(&$values, &$handled) 
        {
    
        }
    
        protected function doCustomCompareColumn($columnName, $valueA, $valueB, &$result)
        {
    
        }
    
        protected function doBeforeInsertRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeUpdateRecord($page, $oldRowData, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doBeforeDeleteRecord($page, &$rowData, $tableName, &$cancel, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterInsertRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterUpdateRecord($page, $oldRowData, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doAfterDeleteRecord($page, $rowData, $tableName, &$success, &$message, &$messageDisplayTime)
        {
    
        }
    
        protected function doCustomHTMLHeader($page, &$customHtmlHeaderText)
        { 
    
        }
    
        protected function doGetCustomTemplate($type, $part, $mode, &$result, &$params)
        {
    
        }
    
        protected function doGetCustomExportOptions(Page $page, $exportType, $rowData, &$options)
        {
    
        }
    
        protected function doFileUpload($fieldName, $rowData, &$result, &$accept, $originalFileName, $originalFileExtension, $fileSize, $tempFileName)
        {
    
        }
    
        protected function doPrepareChart(Chart $chart)
        {
    
        }
    
        protected function doPrepareColumnFilter(ColumnFilter $columnFilter)
        {
    
        }
    
        protected function doPrepareFilterBuilder(FilterBuilder $filterBuilder, FixedKeysArray $columns)
        {
    
        }
    
        protected function doGetSelectionFilters(FixedKeysArray $columns, &$result)
        {
    
        }
    
        protected function doGetCustomFormLayout($mode, FixedKeysArray $columns, FormLayout $layout)
        {
    
        }
    
        protected function doGetCustomColumnGroup(FixedKeysArray $columns, ViewColumnGroup $columnGroup)
        {
    
        }
    
        protected function doPageLoaded()
        {
    
        }
    
        protected function doCalculateFields($rowData, $fieldName, &$value)
        {
    
        }
    
        protected function doGetCustomRecordPermissions(Page $page, &$usingCondition, $rowData, &$allowEdit, &$allowDelete, &$mergeWithDefault, &$handled)
        {
    
        }
    
        protected function doAddEnvironmentVariables(Page $page, &$variables)
        {
    
        }
    
    }

    SetUpUserAuthorization();

    try
    {
        $Page = new produtoPage("produto", "produto.php", GetCurrentUserPermissionsForPage("produto"), 'UTF-8');
        $Page->SetRecordPermission(GetCurrentUserRecordPermissionsForDataSource("produto"));
        GetApplication()->SetMainPage($Page);
        GetApplication()->Run();
    }
    catch(Exception $e)
    {
        ShowErrorPage($e);
    }
	
