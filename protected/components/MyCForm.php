<?php

class MyCForm extends CForm {

	public function renderElement($element)	{
		if (is_string($element)) {
			if(($e = $this[$element]) === null && ($e = $this->getButtons()->itemAt($element)) === null) {
				return $element;
			} else {
				$element = $e;
			}
		}
		if ($element->getVisible()) {
			if ($element instanceof CFormInputElement) {
			 	if ($element->type != 'custom') {
					if ($element->type==='hidden') {
						return "<div style=\"visibility:hidden\">\n".$element->render()."</div>\n";
					} else {
						return "<div class=\"row field_{$element->name}\">\n".$element->render()."</div>\n";
					}
				} else {
					return $this->model->renderCustomField($element,  $this->model);
				}
			} elseif ($element instanceof CFormButtonElement) {
				return $element->render()."\n";
			} else {
				return $element->render();
			}
		}
		return '';
	}
}
