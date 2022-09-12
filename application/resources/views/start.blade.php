<div class="bg-white rounded-top shadow-sm mb-3">

    <div class="row g-0">
        <div class="col col-lg-12 mt-6 p-4 pe-md-0">

        </div>

    <div class="row bg-light m-0 p-4 border-top rounded-bottom">

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <?php if (isset($component)) { $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc = $component; } ?>
                <?php $component = $__env->getContainer()->make(Orchid\Icons\IconComponent::class, ['path' => 'book-open']); ?>
                <?php $component->withName('orchid-icon'); ?>
                <?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc)): ?>
<?php $component = $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc; ?>
<?php unset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <span class="ms-3 text-dark">Инструкции</span>
            </h3>
            <p class="ms-md-5 ps-md-1">
                Переходя к настройкам интеграций, можно увидеть много подсказок. Но бывает их недостаточно, поэтому дополнительно можно посмотреть обучающие видео на
                <a href="" target="_blank" class="text-u-l">YouTube</a>
            </p>
        </div>

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <?php if (isset($component)) { $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc = $component; } ?>
                <?php $component = $__env->getContainer()->make(Orchid\Icons\IconComponent::class, ['path' => 'rocket']); ?>
                <?php $component->withName('orchid-icon'); ?>
                <?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc)): ?>
<?php $component = $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc; ?>
<?php unset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <span class="ms-3 text-dark">Внедрение</span>
            </h3>
            <p class="ms-md-5 ps-md-1">
                Имея большой многолетний опыт внедрения и сопровождения СРМ систем мы можем помочь и Вам!
            </p>
            <div class="px-5">
                {{ \Orchid\Screen\Actions\ModalToggle::make('Оставить заявку')
                        ->modal('requestCRMForm')
                        ->type(\Orchid\Support\Color::DEFAULT())
                        ->method('requestCRMSend')
                }}
            </div>
        </div>

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <?php if (isset($component)) { $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc = $component; } ?>
                <?php $component = $__env->getContainer()->make(Orchid\Icons\IconComponent::class, ['path' => 'monitor']); ?>
                <?php $component->withName('orchid-icon'); ?>
                <?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc)): ?>
<?php $component = $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc; ?>
<?php unset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <span class="ms-3 text-dark">Сайт</span>
            </h3>
            <p class="ms-md-5 ps-md-1">
                Основная информация также размещена на основном сайте, ознакомьтесь с ней перейдя по ссылке <a href="{{ route('site') }}" target="_blank" class="text-u-l">сайте</a>
            </p>

        </div>

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <?php if (isset($component)) { $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc = $component; } ?>
                <?php $component = $__env->getContainer()->make(Orchid\Icons\IconComponent::class, ['path' => 'layers']); ?>
                <?php $component->withName('orchid-icon'); ?>
                <?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc)): ?>
<?php $component = $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc; ?>
<?php unset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <span class="ms-3 text-dark">Доработки</span>
            </h3>
            <p class="ms-md-5 ps-md-1">
                Любая разработка: от простого виджета, до собственной экосистемы поверх СРМ! Только свежий стек технологий и качественный код ;)
                <div class="px-5">
                    {{ \Orchid\Screen\Actions\ModalToggle::make('Оставить заявку')
                            ->modal('requestDevForm')
                            ->type(\Orchid\Support\Color::DEFAULT())
                            ->method('requestDevSend'),
                    }}
                </div>
        </div>

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <?php if (isset($component)) { $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc = $component; } ?>
                <?php $component = $__env->getContainer()->make(Orchid\Icons\IconComponent::class, ['path' => 'star']); ?>
                <?php $component->withName('orchid-icon'); ?>
                <?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc)): ?>
<?php $component = $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc; ?>
<?php unset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <span class="ms-3 text-dark">Лицензии</span>
            </h3>
            <p class="ms-md-5 ps-md-1">
                Являемся официальным партнером amoCRM и поможем продлить/оплатить лицензии. За что готовы дать бонусы на любой вкус!
            <div class="px-5">
                {{ \Orchid\Screen\Actions\ModalToggle::make('Оставить заявку')
                        ->modal('requestLicenseForm')
                        ->type(\Orchid\Support\Color::DEFAULT())
                        ->method('requestLicenseSend')
                }}
            </div>
        </div>

        <div class="col-md-6 my-2">
            <h3 class="text-muted fw-light">
                <?php if (isset($component)) { $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc = $component; } ?>
                <?php $component = $__env->getContainer()->make(Orchid\Icons\IconComponent::class, ['path' => 'help']); ?>
                <?php $component->withName('orchid-icon'); ?>
                <?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php $component->withAttributes([]); ?>
<?php if (isset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc)): ?>
<?php $component = $__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc; ?>
<?php unset($__componentOriginald36eae2be856e5ea3de02a2f65da5a3c27957ebc); ?>
<?php endif; ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>

                <span class="ms-3 text-dark">Обратная связь</span>
            </h3>
            <div class="ms-md-5 ps-md-1">
                В случае возникновения багов, вопросов, предложений или по другим вопросам, можно написать в наш <a href="https://t.me/blackcleverBot" class="text-u-l">Телеграм бот</a>👇
            </div>
        </div>
    </div>

</div>

<?php /**PATH /Users/vyacheslav/PhpstormProjects/widget-bizon/vendor/orchid/platform/resources/views/partials/welcome.blade.php ENDPATH**/ ?>
