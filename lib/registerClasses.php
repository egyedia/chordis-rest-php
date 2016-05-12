<?php
registerClass('db.MysqlConnectionData');
registerClass('db.MysqlDb');
registerClass('db.SPFactory');
registerClass('db.SP');
registerClass('db.SPTemplate');

registerClass('db.sp.SPTemplateSingleRowOrNull');
registerClass('db.sp.SPTemplateList');
registerClass('db.sp.SPTemplateInsert');
registerClass('db.sp.SPTemplateAtom');
registerClass('db.sp.SPTemplateUpdate');
registerClass('db.sp.SPTemplateDelete');
registerClass('db.sp.SPTemplateInsertSelect');
registerClass('db.sp.SPTemplateIterator');
registerClass('db.sp.SPTemplateNumericIterator');
registerClass('db.sp.SPTemplateNumericList');

registerClass('db.iterator.RecordSetAssociativeIterator');
registerClass('db.iterator.RecordSetNumericIterator');


registerClass('option.Options');

registerClass('session.SessionManager');

registerClass('framework.ControlledPage');
registerClass('framework.ControlledObject');
registerClass('framework.ControlledView');
registerClass('framework.RequestContext');
registerClass('framework.ForwardAction');
registerClass('framework.RedirectAction');

registerClass('search.SearchHandler');
registerClass('search.SongDocument');
registerClass('search.IndexableSongDocument');
registerClass('search.SearchResults');
registerClass('search.SearchResultSongRow');
registerClass('search.AbstractSongRowList');

registerClass('oo.Singleton');

registerClass('controller.WebSiteController');

registerClass('website.page.ChordsPage');

registerClass('website.object.ChordsObject');