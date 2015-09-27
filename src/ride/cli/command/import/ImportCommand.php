<?php

namespace ride\cli\command\import;

use ride\cli\command\AbstractCommand;

use ride\library\validation\exception\ValidationException;

/**
 * Command to execute an importer
 */
class ImportCommand extends AbstractCommand {

    /**
     * Initializes the command
     * @return null
     */
    protected function initialize() {
        $this->setDescription('Execute the provided importer');

        $this->addArgument('id', 'Dependency id of the import implementation');
    }

    /**
     * Invokes the command
     * @param string $id
     * @return null
     */
    public function invoke($id) {
        $importer = $this->dependencyInjector->get('ride\\library\\import\\Importer', $id);

        try {
            $importer->import();
        } catch (ValidationException $exception) {
            $this->output->writeLine($exception->getErrorsAsString());

            throw $exception;
        }
    }

}
