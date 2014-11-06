<?php

namespace ride\cli\command\import;

use ride\library\cli\command\AbstractCommand;
use ride\library\dependency\DependencyInjector;

/**
 * Command to execute an importer
 */
class ImportCommand extends AbstractCommand {

    /**
     * Instance of the dependency injector
     * @var ride\library\dependency\DependencyInjector
     */
    protected $dependencyInjector;

    /**
     * Constructs a new import command
     * @param \ride\library\dependency\DependencyInjector
     * @return null
     */
    public function __construct(DependencyInjector $dependencyInjector) {
        parent::__construct('import', 'Execute the provided importer');

        $this->addArgument('id', 'Dependency id of the import implementation', true);

        $this->dependencyInjector = $dependencyInjector;
    }

    /**
     * Executes the command
     * @return null
     */
    public function execute() {
        $id = $this->input->getArgument('id');

        $importer = $this->dependencyInjector->get('ride\\library\\import\\Importer', $id);
        $importer->import();
    }

}
