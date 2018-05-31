<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ProductAlternativeGui\Communication\Plugin;

use Generated\Shared\Transfer\ProductAlternativeCollectionTransfer;
use Generated\Shared\Transfer\ProductConcreteTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductManagementExtension\Dependency\Plugin\ProductConcreteFormEditDataProviderExpanderPluginInterface;

/**
 * @method \Spryker\Zed\ProductAlternativeGui\Communication\ProductAlternativeGuiCommunicationFactory getFactory()
 * @method \Spryker\Zed\ProductAlternativeGui\Business\ProductAlternativeGuiFacadeInterface getFacade()
 */
class ProductConcreteFormEditDataProviderExpanderPlugin extends AbstractPlugin implements ProductConcreteFormEditDataProviderExpanderPluginInterface
{
    /**
     * {@inheritdoc}
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\ProductConcreteTransfer $productConcrete
     * @param array $formData
     *
     * @return void
     */
    public function expand(ProductConcreteTransfer $productConcrete, array &$formData): void
    {
        $productAlternatives = $this
            ->getFactory()
            ->getProductAlternativeFacade()
            ->getProductAlternativesByIdProductConcrete($productConcrete);

        $formData[ProductAlternativeCollectionTransfer::PRODUCT_ALTERNATIVES] = $productAlternatives->getProductAlternatives();
    }
}